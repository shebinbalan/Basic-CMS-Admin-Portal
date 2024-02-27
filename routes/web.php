<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Front\FrontendController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/', [FrontendController::class,'index'])->name('home');;
Route::get('/posts', [FrontendController::class,'posts'])->name('posts');
Route::get('/posts/{post}', [FrontendController::class,'showPost'])->name('posts.view');
Route::get('/category/{category}', [FrontendController::class,'showCategory'])->name('categories.view');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth','isAdmin'])->group(function(){
    Route::get('/home', [App\Http\Controllers\Admin\FrontendController::class,'index']);
    Route::get('/categories', [App\Http\Controllers\Admin\CategoryController::class,'index']);
    Route::get('/add-category', [App\Http\Controllers\Admin\CategoryController::class,'add']);
    Route::post('/insert-category', [App\Http\Controllers\Admin\CategoryController::class,'insert']);
    Route::get('/edit-category/{id}', [App\Http\Controllers\Admin\CategoryController::class,'edit']);
    Route::put('/update-category/{id}', [App\Http\Controllers\Admin\CategoryController::class,'update']);
    Route::get('/delete-category/{id}', [App\Http\Controllers\Admin\CategoryController::class,'destroy']);

    Route::get('/tags', [App\Http\Controllers\Admin\TagController::class,'index']);
    Route::get('/add-tag', [App\Http\Controllers\Admin\TagController::class,'add']);
    Route::post('/insert-tag', [App\Http\Controllers\Admin\TagController::class,'insert']);
    Route::get('/edit-tag/{id}', [App\Http\Controllers\Admin\TagController::class,'edit']);
    Route::put('/update-tag/{id}', [App\Http\Controllers\Admin\TagController::class,'update']);
    Route::get('/delete-tag/{id}', [App\Http\Controllers\Admin\TagController::class,'destroy']);

    Route::get('/posts', [App\Http\Controllers\Admin\PostController::class,'index']);
    Route::get('/add-post', [App\Http\Controllers\Admin\PostController::class,'add']);
    Route::post('/insert-post', [App\Http\Controllers\Admin\PostController::class,'insert']);
    Route::get('/ edit-post/{id}', [App\Http\Controllers\Admin\PostController::class,'edit']);
    Route::put('/update-post/{id}', [App\Http\Controllers\Admin\PostController::class,'update']);
    Route::get('/delete-post/{id}', [App\Http\Controllers\Admin\PostController::class,'destroy']);

    
 });
