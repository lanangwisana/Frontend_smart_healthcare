<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/index', function () {
    return view('index');
});

// Halaman login & register (frontend only)
Route::view('/', 'auth.login-pasien')->name('login');
Route::view('/login', 'auth.login-pasien');
Route::view('/register', 'auth.register-pasien');

// Dashboard pasien (nanti bisa ditambah middleware auth kalau backend sudah siap)
Route::view('/landingpage-pasien', 'pasien.landingpage-pasien')->name('landingpage.pasien');
Route::view('/booking-pasien', 'pasien.booking-pasien')->name('booking.pasien');
Route::view('/pasien/dashboard-pasien', 'pasien.dashboard-pasien')->name('dashboard.pasien');