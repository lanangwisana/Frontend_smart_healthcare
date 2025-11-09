<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| ROUTE AUTENTIKASI
|--------------------------------------------------------------------------
*/

// 🟢 Halaman Login
Route::get('/login', function () {
    return view('admin.login');
})->name('login');

// 🟢 Proses Login
Route::post('/login', function () {
    // Simulasi proses login
    return redirect()->route('dashboard')->with('success', 'Selamat datang! Anda berhasil masuk.');
})->name('login.post');

// 🟢 Logout
Route::post('/logout', function () {
    return redirect()->route('login')->with('success', 'Anda telah berhasil keluar.');
})->name('logout');

/*
|--------------------------------------------------------------------------
| ROUTE DASHBOARD & FITUR CLINIC
|--------------------------------------------------------------------------
*/

// 🏠 Dashboard Utama
Route::get('/dashboard', function () {
    return view('admin.index');
})->name('dashboard');

// 📅 Manajemen Appointment - Update Status
Route::put('/appointments/{appointment}/update-status', function ($appointment) {
    return redirect()->route('dashboard')->with('success', 'Status Appointment ' . $appointment . ' berhasil diperbarui.');
})->name('appointments.update.status');

// 🧾 Rekam Medis - Simpan Data
Route::post('/medical-records/store', function () {
    return redirect()->route('dashboard')->with('success', 'Rekam Medis/Hasil berhasil disimpan.');
})->name('records.store');

// 🧩 Rekam Medis - Tampilkan Detail
Route::get('/medical-records/show/{record}', function ($record) {
    return "Menampilkan detail Rekam Medis dengan ID: " . $record;
})->name('records.show');
