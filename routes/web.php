<?php

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartaController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoriaController;
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
    return view('welcome');
});

    //esto fuchi fuchi del return
    Route::post('/admin/categorias', [CategoriaController::class, 'store'])->name('admin.categorias.store');
    Route::delete('/admin/categorias/{id}', [CategoriaController::class, 'destroy'])->name('admin.categorias.destroy');

    Route::get('/categorias', [CategoriaController::class, 'index'])->name('categorias.index');
    Route::get('/categorias/create', [CategoriaController::class, 'create'])->name('categorias.create');
    Route::post('/categorias', [CategoriaController::class, 'store'])->name('categorias.store');
    Route::delete('/categorias/{id}', [CategoriaController::class, 'destroy'])->name('categorias.destroy');
    Route::get('/cartas/crear', [CartaController::class, 'create'])->name('cartas.create');
    Route::post('/cartas', [CartaController::class, 'store'])->name('cartas.store');
    Route::get('/cartas/buscar', [CartaController::class, 'buscar'])->name('cartas.buscar');
    Route::get('/cartas/mis-cartas', [CartaController::class, 'misCartas'])->name('cartas.mis');
    Route::delete('/cartas/{id}', [CartaController::class, 'destroy'])->name('cartas.destroy');
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
    Route::post('/admin', [AdminController::class, 'store'])->name('admin.store');
    Route::delete('/usuarios/{id}', [AdminController::class, 'destroy'])->name('user.destroy');
    Route::get('cartas/admin', [CartaController::class, 'adminCartas'])->name('cartas.admin');
    Route::post('/admin/cartas', [AdminController::class, 'storeCarta'])->name('admin.cartas.store');
    Route::delete('/admin/cartas/{id}', [AdminController::class, 'eliminarCarta'])->name('admin.cartas.destroy');
    Route::get('/inicio', [CartaController::class, 'inicio'])->name('inicio');
    Route::get('/catalogo', [CartaController::class, 'catalogo'])->name('catalogo');