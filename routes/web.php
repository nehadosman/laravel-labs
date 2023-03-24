<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;


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

Route::resource('posts', PostController::class)->middleware('auth');

// Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
// Route::get('/posts/edit/{post}', [PostController::class, 'edit'])->name('posts.edit');
// Route::post('/posts/update/{post}', [PostController::class, 'update'])->name('posts.update');
// Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');

// Route::group(['middleware' => ['auth']], function () {
//     Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
//     Route::get('/posts/{post}', [PostController::class, 'show'])->name('posts.show');
//     Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
// });

Route::post('/comments', [CommentController::class, 'store'])->name('comments.store');
Route::put('/comments/{comment}', [CommentController::class, 'update'])->name('comments.update');
Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
