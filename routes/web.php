<?php

use App\Http\Controllers\FacturasController;
use App\Http\Controllers\ProductosController;
use App\Http\Controllers\VentasController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin'       => Route::has('login'),
        'canRegister'    => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion'     => PHP_VERSION,
    ]);
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/inicio', function () {
        return Inertia::render('Inicio');
    })->name('inicio');

    Route::get('/carrito', function () {
        return Inertia::render('Carrito');
    })->name('carrito');

    Route::resource('productos', ProductosController::class, ['only' => ['index', 'edit', 'update', 'create', 'store']]);
    Route::resource('articulos-de-venta', VentasController::class, ['only' => ['index', 'show']]);
    Route::resource('pedidos', FacturasController::class, ['only' => ['store', 'edit', 'show', 'index', 'update']]);

});
