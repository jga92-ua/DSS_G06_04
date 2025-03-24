<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartaController;
use App\Http\Controllers\AdminController;
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

