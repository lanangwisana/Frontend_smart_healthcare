<?php

use App\Http\Controllers\FrontAuthController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes (Akses Langsung ke View Index)
|--------------------------------------------------------------------------
*/

// Hapus middleware untuk debugging view/route.
// Nanti, Anda perlu menambahkan kembali autentikasi dan role yang benar!
Route::prefix('clinic')->name('clinic.')->group(function () {

    // 1. DASHBOARD UTAMA
    // Route: GET /clinic/dashboard
    Route::get('/dashboard', function () {
        // Langsung me-render view index.blade.php
        return view('index'); 
    })->name('dashboard');

    // 2. MANAGEMENT APPOINTMENT (Approve/Reject)
    Route::prefix('appointments')->name('appointments.')->group(function () {
        
        // Endpoint untuk update status (Approve atau Tolak)
        // URL: PUT /clinic/appointments/{appointment}/update-status
        Route::put('/{appointment}/update-status', function ($appointment) {
            // Simulasi aksi: redirect kembali
            return redirect()->route('clinic.dashboard')->with('success', 'Status Appointment ' . $appointment . ' berhasil diperbarui.');
        })->name('update.status'); 
    });

    // 3. REKAM MEDIS & INPUT HASIL
    Route::prefix('medical-records')->name('records.')->group(function () {
        
        // URL: POST /clinic/medical-records/store
        Route::post('/store', function () {
            // Simulasi aksi: redirect kembali
            return redirect()->route('clinic.dashboard')->with('success', 'Rekam Medis/Hasil berhasil disimpan.');
        })->name('store');
        
        // URL: GET /clinic/medical-records/show/{record}
        Route::get('/show/{record}', function ($record) {
             return "Menampilkan detail Rekam Medis dengan ID: " . $record;
        })->name('show');
    });
});
