<?php

use App\Http\Controllers\ComentarioController;
use App\Http\Controllers\FollowerController;
use App\Http\Controllers\ImagenController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\PerfilController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RegisterController;
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
    return view('principal');
});

/* ===================================================
   RUTAS PARA REGISTER
===================================================*/
Route::get('/register', [RegisterController::class, 'index'])->name('register.index');
Route::post('/register', [RegisterController::class, 'store'])->name('register.store');

/* ===================================================
   RUTAS PARA LOGIN
===================================================*/
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'store']);
Route::post('/logout', [LogoutController::class, 'store'])->name('logout'); // ? con get puede ser inseguro, por eso lo cambiamos a post para incluir csrf

/* ===================================================
   RUTAS PARA PERFIL
===================================================*/
Route::get('/editar-perfil', [PerfilController::class, 'index'])->name('perfil.index');
Route::post('/editar-perfil', [PerfilController::class, 'store'])->name('perfil.store');
Route::post('/editar-perfil/password', [PerfilController::class, 'updatePassword'])->name('perfil.updatePassword');

/* ===================================================
   RUTAS PARA POSTS
===================================================*/
Route::get('/{user:username}', [PostController::class, 'index'])->name('posts.index'); // ? Route model binding
Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create'); 
Route::post('/posts', [PostController::class, 'store'])->name('posts.store'); 
Route::get('/{user:username}/posts/{post}', [PostController::class, 'show'])->name('posts.show'); 
Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy'); 

/* ===================================================
   RUTAS PARA COMENTARIOS
===================================================*/
Route::post('/{user:username}/posts/{post}', [ComentarioController::class, 'store'])->name('comentarios.store'); 

/* ===================================================
   RUTAS PARA IMAGENES
===================================================*/
Route::post('/imagenes', [ImagenController::class, 'store'])->name('imagenes.store');

/* ===================================================
    RUTAS LIKES FOTOS
===================================================*/
Route::post('/posts/{post}/likes', [LikeController::class, 'store'])->name('posts.likes.store');
Route::delete('/posts/{post}/likes', [LikeController::class, 'destroy'])->name('posts.likes.destroy');

/* ===================================================
   RUTAS FOLLOWING USERS
===================================================*/
Route::post('/{user:username}/follow', [FollowerController::class, 'store'])->name('users.follow');
Route::delete('/{user:username}/unfollow', [FollowerController::class, 'destroy'])->name('users.unfollow');