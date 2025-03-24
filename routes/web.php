<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartaController;
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


