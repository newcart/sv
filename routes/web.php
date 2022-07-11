<?php

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
Route::get('/', function(){
    return view('welcome');
})->name('home.index');
Route::middleware( 'auth:sanctum')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('home.index');
    Route::get('/myprofile', [App\Http\Controllers\UserController::class, 'myprofile'])->name('myprofile');
    Route::get('/user/edit/{id}', [App\Http\Controllers\UserController::class, 'edit'])->name('user.edit');
    Route::get('/user/list', [App\Http\Controllers\UserController::class, 'index'])->name('user.list');
    Route::get('/user/create', [App\Http\Controllers\UserController::class, 'create'])->name('user.create');
    Route::get('/api/user/get/{id}', [App\Http\Controllers\UserController::class, 'apiget'])->name('user.apiget');
    Route::post('/api/user/save/{id}', [App\Http\Controllers\UserController::class, 'apipost'])->name('user.apipost');
    Route::get('/api/user/list', [App\Http\Controllers\UserController::class, 'apilist'])->name('user.apilist');

    Route::get('/post/list', [App\Http\Controllers\PostController::class, 'index'])->name('post.list');
    Route::get('/post/create', [App\Http\Controllers\PostController::class, 'create'])->name('post.create');
    Route::get('/post/edit/{id}', [App\Http\Controllers\PostController::class, 'edit'])->name('post.edit');
    Route::post('/post/store', [App\Http\Controllers\PostController::class, 'store'])->name('post.store');
    Route::get('/post/page', [App\Http\Controllers\PostController::class, 'page'])->name('post.page');
    Route::get('/api/post/list', [App\Http\Controllers\PostController::class, 'apilist'])->name('post.apilist');
    Route::get('/api/post/get/{id}', [App\Http\Controllers\PostController::class, 'apiget'])->name('post.apiget');
    Route::post('/api/post/save/{id}', [App\Http\Controllers\PostController::class, 'apipost'])->name('post.apipost');
});
