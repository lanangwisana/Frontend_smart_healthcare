<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/index', function () {
    return view('index');
});

// Halaman login & register (frontend only)
Route::view('/', 'auth.login')->name('login');
Route::view('/login', 'auth.login');
Route::view('/register', 'auth.register');

// Dashboard pasien (nanti bisa ditambah middleware auth kalau backend sudah siap)
Route::view('/landingpage', 'landingpage');
Route::view('/booking', 'booking')->name('booking');
Route::view('/dashboard', 'dashboard')->name('dashboard');