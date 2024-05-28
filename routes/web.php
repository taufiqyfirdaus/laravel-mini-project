<?php

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

Route::get('/', function () {return view('home');})->name('home');

Route::get('/login', [UserController::class, 'login'])->name('login');
Route::post('/login', [UserController::class, 'loginUser'])->name('login-user');
Route::get('/register', [UserController::class, 'register'])->name('register');
Route::post('/register-user', [UserController::class, 'registerUser'])->name('register-user');
Route::get('/logout', [UserController::class, 'logout'])->name('logout');