<?php

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartaController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\PerfilController;
use App\Http\Controllers\CestaController;

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

//  Página de inicio y catálogo
Route::get('/inicio', [CartaController::class, 'inicio'])->name('inicio');
Route::get('/catalogo', [CartaController::class, 'catalogo'])->name('catalogo');
Route::get('/registro', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/registro', [RegisterController::class, 'register'])->name('register.post');

//  Panel de administración
Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
Route::post('/admin', [AdminController::class, 'store'])->name('admin.store');
Route::delete('/usuarios/{id}', [AdminController::class, 'destroy'])->name('user.destroy');
Route::get('/admin/usuarios/{id}/edit', [AdminController::class, 'edit'])->name('admin.usuarios.edit');
Route::post('/admin/usuarios/{id}/update', [AdminController::class, 'update'])->name('admin.usuarios.update');
// Vista y acción de edición de cartas desde el panel de admin

// Cartas (CRUD)
Route::get('/cartas/crear', [CartaController::class, 'create'])->name('cartas.create');
Route::post('/cartas', [CartaController::class, 'store'])->name('cartas.store');
Route::get('/cartas/buscar', [CartaController::class, 'buscar'])->name('cartas.buscar');
Route::middleware(['auth'])->group(function () {
    // Perfil (ya está)
    Route::get('/perfil', [PerfilController::class, 'index'])->name('perfil');
    Route::post('/perfil/password', [PerfilController::class, 'actualizarContraseña'])->name('perfil.password');
    Route::post('/perfil/usuario', [PerfilController::class, 'actualizarUsuario'])->name('perfil.usuario');
    Route::post('/perfil/direccion', [PerfilController::class, 'actualizarDireccion'])->name('perfil.direccion');
    Route::post('/perfil/foto', [PerfilController::class, 'actualizarFoto'])->name('perfil.foto');

    // Añade aquí la ruta protegida
    Route::get('/cartas/mis-cartas', [CartaController::class, 'misCartas'])->name('cartas.mis');
});
Route::get('/cartas/{id}/edit', [CartaController::class, 'edit'])->name('cartas.edit');
Route::put('/cartas/{id}/update', [CartaController::class, 'update'])->name('cartas.update');
Route::delete('/cartas/{id}', [CartaController::class, 'destroy'])->name('cartas.destroy');
Route::post('/cesta/agregar', [CestaController::class, 'agregar'])->name('cesta.agregar');
Route::get('/cartas/{id}', [CartaController::class, 'show'])->name('cartas.show');

// Cartas desde panel de admin
Route::get('/cartas/admin', [CartaController::class, 'adminCartas'])->name('cartas.admin');
Route::post('/admin/cartas', [AdminController::class, 'storeCarta'])->name('admin.cartas.store');
Route::delete('/admin/cartas/{id}', [AdminController::class, 'eliminarCarta'])->name('admin.cartas.destroy');
Route::get('/admin/cartas/{id}/edit', [CartaController::class, 'editAdmin'])->name('cartas.edit.admin');
Route::put('/admin/cartas/{id}', [CartaController::class, 'updateAdmin'])->name('cartas.update.admin');



// Categorías (CRUD)
Route::get('/categorias', [CategoriaController::class, 'index'])->name('categorias.index');
Route::get('/categorias/create', [CategoriaController::class, 'create'])->name('categorias.create');
Route::post('/categorias', [CategoriaController::class, 'store'])->name('categorias.store');
Route::get('/categorias/{id}/edit', [CategoriaController::class, 'edit'])->name('categorias.edit');
Route::put('/categorias/{id}', [CategoriaController::class, 'update'])->name('categorias.update');
Route::delete('/categorias/{id}', [CategoriaController::class, 'destroy'])->name('categorias.destroy');

//  Categorías desde panel de admin
Route::post('/admin/categorias', [CategoriaController::class, 'store'])->name('admin.categorias.store');
Route::delete('/admin/categorias/{id}', [CategoriaController::class, 'destroy'])->name('admin.categorias.destroy');
Route::get('/admin/categorias', [CategoriaController::class, 'adminIndex'])->name('admin.categorias');

//Cesta
Route::get('/cesta', [CestaController::class, 'index'])->name('cesta.index');
Route::post('/cesta/agregar/{id}', [CestaController::class, 'añadir'])->name('cesta.anadir');
Route::post('/cesta/eliminar/{id}', [CestaController::class, 'eliminar'])->name('cesta.eliminar');
Route::post('/cesta/comprar', [CestaController::class, 'comprar'])->name('cesta.comprar');
Route::post('/cesta/incrementar/{id}', [CestaController::class, 'incrementar'])->name('cesta.incrementar');
Route::post('/cesta/decrementar/{id}', [CestaController::class, 'decrementar'])->name('cesta.decrementar');
Route::post('/cesta/vaciar', [CestaController::class, 'vaciar'])->name('cesta.vaciar');


//Politica de privacidad y terminos de uso
Route::get('/terminos-de-servicio', function () {return view('terminos');})->name('terminos');
Route::get('/politica-de-privacidad', function () {return view('privacidad');})->name('privacidad');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/perfil', function () {
    return view('perfil');
})->name('perfil')->middleware('auth');

Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::get('/perfil', [PerfilController::class, 'index'])->name('perfil');
    Route::post('/perfil/password', [PerfilController::class, 'actualizarContraseña'])->name('perfil.password');
    Route::post('/perfil/usuario', [PerfilController::class, 'actualizarUsuario'])->name('perfil.usuario');
    Route::post('/perfil/direccion', [PerfilController::class, 'actualizarDireccion'])->name('perfil.direccion');
    Route::post('/perfil/foto', [PerfilController::class, 'actualizarFoto'])->name('perfil.foto');
});