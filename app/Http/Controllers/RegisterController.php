<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{

    public function index()
    {
        // $categorias = DB::table('categorias')->get();

        //dd($categorias);
        return view('auth.register');
    }

    public function show()
    {
        if (Auth::check()) {
            return redirect('categoria.index');
        }
        return view('auth.register');
    }

    public function register(RegisterRequest $request)
    {
        //dd($request);
        $user = User::create($request->validated());
        return redirect('/login')->with('success', 'Account created successfully');
    }
}
