<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoriaRequest;
use App\Http\Requests\UpdateCategoriaRequest;
use App\Models\Categoria;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categorias = DB::table('categorias')->get();

        //dd($categorias);
        return view('categoria.index', ['categorias' => $categorias]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return view('categoria.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoriaRequest $request)
    {
        //dd($request);
        // try {
        //     DB::beginTransaction();
        //     //$user = DB::table('categorias')->insertGetId($request);
        //     $user = Categoria::create($request->validated());
        //     DB::commit();
        // } catch (Exception $e) {
        //     DB::rollBack();
        // }
        $user = Categoria::create($request->validated());
        return redirect()->route('categorias.index')->with('success', 'Categoria registrada');
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
    public function edit(Categoria $categoria)
    {
        return view('categoria.edit', ['categoria' => $categoria]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoriaRequest $request, Categoria $categoria)
    {
        // dd($request);
        Categoria::where('id', $categoria->id)
            ->update($request->validated());

        return redirect()->route('categorias.index')->with('success', 'Categoria editada');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $message = '';
        $categoria = Categoria::find($id);
        if ($categoria->estado == 1) {
            Categoria::where('id', $categoria->id)
                ->update([
                    'estado' => 0
                ]);
            $message = 'Categoria eliminada';
        } else {
            Categoria::where('id', $categoria->id)
                ->update([
                    'estado' => 1
                ]);
            $message = 'Categoria restaurada';
        }

        return redirect()->route('categorias.index')->with('success', $message);
    }
}
