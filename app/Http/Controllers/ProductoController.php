<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductoRequest;
use App\Http\Requests\UpdateProductoRequest;
use App\Models\Categoria;
use App\Models\Producto;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $productos = Producto::with(['categoria'])->latest()->get();
        //dd($productos);
        return view('producto.index', compact('productos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categorias = Categoria::where('estado', 1)->get();
        //dd($categorias);
        return view('producto.create', compact('categorias'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductoRequest $request)
    {
        //dd($request);
        try {

            DB::beginTransaction();
            $producto = new Producto();
            if ($request->hasFile('img_path')) {
                $name = $request->file('img_path')->store('img/productos', 'public');
            } else {
                $name = null;
            }

            Producto::create([
                'nombre' => $request->nombre,
                'descripcion' => $request->descripcion,
                'precio_unitario' => $request->precio_unitario,
                'img_path' => $name,
                'categoria_id' => $request->categoria_id,
            ]);

            // $producto->fill([
            //     'nombre' => $request->nombre,
            //     'descripcion' => $request->descripcion,
            //     'precio_unitario' => $request->precio_unitario,
            //     'img_path' => $name,
            //     'categoria_id' => $request->categoria_id,
            // ]);

            //$producto->save();

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
        }

        return redirect()->route('productos.index')->with('success', 'Productos registrado');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Producto $producto)
    {
        $categorias = Categoria::where('estado', 1)->get();

        return view('producto.edit', compact('producto', 'categorias'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductoRequest $request, Producto $producto)
    {
        try {

            DB::beginTransaction();
            if ($request->hasFile('img_path')) {
                //$name = $producto->handleUploadImage($request->file('img_path'));

                //Eliminar si existe una imagen
                if (Storage::disk('public')->exists('img/productos/' . $producto->img_path)) {
                    Storage::disk('public')->delete('img/productos/' . $producto->img_path);
                }
            } else {
                $name = $producto->img_path;
            }
            $name = $producto->handleUploadImage($request->file('img_path'));

            // Actualizar el producto existente
            $producto->nombre = $request->nombre;
            $producto->descripcion = $request->descripcion;
            $producto->precio_unitario = $request->precio_unitario;
            $producto->img_path = $name;
            $producto->categoria_id = $request->categoria_id;

            $producto->save();
            // Producto::update([
            //     'nombre' => $request->nombre,
            //     'descripcion' => $request->descripcion,
            //     'precio_unitario' => $request->precio_unitario,
            //     'img_path' => $name,
            //     'categoria_id' => $request->categoria_id,
            // ]);
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
        }
        return redirect()->route('productos.index')->with('success', 'Producto editado');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $message = '';
        $producto = Producto::find($id);
        if ($producto->estado == 1) {
            Producto::where('id', $producto->id)
                ->update([
                    'estado' => 0
                ]);
            $message = 'Producto eliminado';
        } else {
            Producto::where('id', $producto->id)
                ->update([
                    'estado' => 1
                ]);
            $message = 'Producto restaurado';
        }

        return redirect()->route('productos.index')->with('success', $message);
    }
}
