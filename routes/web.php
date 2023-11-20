<?php

use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\CompraController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/login', function () {
//     return view('auth.login');
// });

// Route::get('/register', function () {
//     return view('auth.register');
// });
Route::get('/login', [LoginController::class, 'show']);
Route::post('/login', [LoginController::class, 'login']);
Route::get('/register', [RegisterController::class, 'show']);
Route::post('/register', [RegisterController::class, 'register']);
Route::get('/logout', [LogoutController::class, 'logout']);

Route::view('/panel', 'panel.index')->name('panel');

// Route::resource('categorias', CategoriaController::class,);
// Route::get('/create', [CategoriaController::class, 'create']);
// Route::get('/edit', [CategoriaController::class, 'edit']);

// Route::resource('productos', ProductoController::class,);
// Route::get('/create', [ProductoController::class, 'create']);
// Route::get('/edit', [ProductoController::class, 'edit']);

// Route::resource('compras', CompraController::class,);
// Route::get('/create', [CompraController::class, 'create']);
//Route::post('/register', [RegisterController::class, 'register']);

// Route::post('/register', function () {
//     return view('auth.register');
// });

Route::resources([
    'categorias' => CategoriaController::class,
    'productos' => ProductoController::class,
    'compras' => CompraController::class,
]);
