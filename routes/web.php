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

    Route::get('/store/create', [App\Http\Controllers\StoreController::class, 'create'])->name('store.create');
    Route::get('/store/list', [App\Http\Controllers\StoreController::class, 'index'])->name('store.list');
    Route::get('/store/edit/{id}', [App\Http\Controllers\StoreController::class, 'edit'])->name('store.edit');
    //Route::post('/post/store', [App\Http\Controllers\PostController::class, 'store'])->name('post.store');
    //Route::get('/post/page', [App\Http\Controllers\PostController::class, 'page'])->name('post.page');
    Route::get('/api/store/get/{id}', [App\Http\Controllers\StoreController::class, 'apiget'])->name('store.apiget');
    Route::post('/api/store/save/{id}', [App\Http\Controllers\StoreController::class, 'apipost'])->name('store.apipost');
    Route::get('/api/store/list', [App\Http\Controllers\StoreController::class, 'apilist'])->name('store.apilist');
});

