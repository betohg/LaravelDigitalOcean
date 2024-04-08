<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\SmsController;
use App\Http\Controllers\Auth\VeryfiController;
use App\Http\Controllers\Auth\ApplicationController;
use App\Http\Controllers\ProductoController;
use App\Models\Producto;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Route::middleware('auth')->group(function () {
    Route::get('/', function () {
        $productos = Producto::all(); // Obtén todos los productos
        return view('home', compact('productos')); // Pasa la variable $productos a la vista
    })->name('home');

    Route::get('/products', [ProductoController::class, 'create'])->name('products.index');
    Route::post('/products', [ProductoController::class, 'store'])->name('products.store');

    Route::get('/productsindex', [ProductoController::class, 'index'])->name('products.table');

    Route::get('/products/{id}/edit', [ProductoController::class, 'edit'])->name('productos.edit');
    Route::put('/products/{id}', [ProductoController::class, 'update'])->name('productos.update');

    Route::delete('/products/{id}', [ProductoController::class, 'destroy'])->name('productos.destroy');

    Route::get('/logout', [LoginController::class, 'destroy'])->name('login.destroy');
});

Route::middleware('guest')->group(function () {
    Route::get('/register', [RegisterController::class, 'create'])->name('register.index');
    Route::post('/register', [RegisterController::class, 'store'])->name('register.store');

    Route::get('/login', [LoginController::class, 'create'])->name('login.index');
    Route::post('/login', [LoginController::class, 'store'])->name('login.store');

    Route::get('/phone', [SmsController::class, 'create'])->name('auth.phone');

    Route::post('/phone', [SmsController::class, 'store'])->name('auth.store');

    Route::get('/verification', [VeryfiController::class, 'create'])->name('auth.verification');
    Route::post('/verification', [VeryfiController::class, 'store'])->name('auth.storeve');

    Route::get('/application', [ApplicationController::class, 'create'])->name('app.verification');
    Route::post('/application', [ApplicationController::class, 'store'])->name('app.store');

    

});