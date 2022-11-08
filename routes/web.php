<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;

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
Route::get('/', [IndexController::class, 'index']);

Route::get('login', function () {
    session()->forget('user');
    return view('login');
});
Route::post('loginAction', [IndexController::class, 'loginAction']);

Route::resource('user', UserController::class);
Route::get('user/{user}/posts', [UserController::class, 'posts'])->name("user.posts");
Route::get('user/{user}/comments', [UserController::class, 'comments'])->name("user.comments");

Route::resource('category', CategoryController::class);
Route::resource('post', PostController::class);
Route::resource('comment', CommentController::class);

