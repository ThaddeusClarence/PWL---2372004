<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Models\User; // Penting untuk mengambil data user di route laporan

// 1. Halaman Utama
Route::get('/', function () {
    return view('welcome');
});

// 2. Dashboard Logic (Otomatis Redirect sesuai Role)
Route::get('/dashboard', function () {
    if (Auth::check() && Auth::user()->role === 'admin') {
        return redirect()->route('admin.dashboard');
    }
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// 3. Route Khusus Admin & Fitur Laporan
Route::middleware(['auth'])->group(function () {
    // Halaman Dashboard Admin Utama
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');

    // Fitur Cetak Laporan Otomatis (Menggantikan pesan "Sedang Disiapkan")
    Route::get('/admin/print-laporan', function () {
        // Mengambil 20 data pengguna terbaru untuk laporan
        $recentUsers = User::latest()->take(20)->get();
        
        // Memanggil file resources/views/admin/laporan.blade.php
        return view('admin.laporan', compact('recentUsers'));
    })->name('admin.print.laporan');
});

// 4. Route Profile (Bawaan Laravel Breeze)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';