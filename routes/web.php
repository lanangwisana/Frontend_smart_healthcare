<?php

use App\Http\Controllers\FrontAuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

use App\Http\Controllers\AuthController;

Route::get('/login', [FrontAuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [FrontAuthController::class, 'login']);

Route::get('/register', [FrontAuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [FrontAuthController::class, 'register']);
