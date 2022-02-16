<?php

use App\Http\Controllers\AutorController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\EditorialController;
use App\Http\Controllers\LibroController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;

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
    return view('landing');
});

// Rutas para los `usuarios` del sistema
Route::resource("/users", UserController::class);

// Rutas para el `login`
Route::post('/login', [LoginController::class, 'login']);
Route::get('/login', [LoginController::class, 'mostrarFormulario'])->name('login');
Route::get('/logout',[LoginController::class, 'logout']);

// Rutas para los `autores` de libros
Route::resource('/autores', AutorController::class);
Route::get('/getAutores', [SearchController::class, 'search'])->name('getAutores');
Route::get('/autores', [AutorController::class, 'index'])->name('autores');
Route::get('/autorId/{autor}', 'AutorController@getId')->name('autorId');

// Rutas para las `categorias` de libros
Route::resource('/categorias', CategoriaController::class);
Route::get('/getCategorias', [SearchController::class, 'search'])->name('getCategorias');
Route::get('/categorias', [CategoriaController::class, 'index'])->name('categorias');

// Rutas para las `editoriales` de libros
Route::resource('/editoriales', EditorialController::class);
Route::get('/getEditoriales', [SearchController::class, 'search'])->name('getEditoriales');
Route::get('/editoriales', [EditorialController::class, 'index'])->name('editoriales');

// Rutas para los `libros`
Route::resource('/libros', LibroController::class);
Route::get('/getLibros', [SearchController::class, 'searchLibros'])->name('getLibros');
Route::get('/libros', [LibroController::class, 'index'])->name('libros');
Route::get('/libro/Detalle', [LibroController::class, 'detail'])->name('getDetail');
// Route::post('/autocomplete/fetch', 'SearchController@fetch')->name('autocompletefetch');
Route::post('/autocomplete/fetch', [LibroController::class, 'fetch'])->name('autocompletefetch');
Route::get('/libros', [LibroController::class, 'index'])->name('libros');

Route::post('/img', [ImgController::class, 'img'])->name('portada');

// Ruta para la `Imagen` de `Portada`
Route::post('/imagen', function(Request $request){
    return view('queryImage');
})->name('img');