<?php

use App\Http\Controllers\ExploreController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [PostController::class, 'showPost'])->name('home');
Route::get('/seePost/{post}', [PostController::class, 'showDetailPost'])->name('see-post');

Route::get('/explore-people', [ExploreController::class, 'index'])->name('explore');
Route::get('/search', [ExploreController::class, 'search'])->name('explore-search');

Route::get('/login', [UserController::class, 'login'])->name('login');
Route::post('/login', [UserController::class, 'loginUser'])->name('login-user');
Route::get('/register', [UserController::class, 'register'])->name('register');
Route::post('/register-user', [UserController::class, 'registerUser'])->name('register-user');
Route::get('/logout', [UserController::class, 'logout'])->name('logout');

Route::prefix('')->middleware('authenticate')->group(function () {
    Route::get('/my-profile', [UserController::class, 'showProfile'])->name('show-profile');
    Route::get('/form-post', [PostController::class, 'showFormAdd'])->name('show-form-add-post');
    Route::post('/{user}/store', [PostController::class, 'store'])->name('store-post');
});