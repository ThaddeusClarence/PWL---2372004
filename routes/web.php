<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// 1. Halaman Utama
Route::get('/', function () {
    return view('welcome');
});

// 2. Dashboard Logic (Otomatis Redirect sesuai Role)
Route::get('/dashboard', function () {
    // Berdasarkan database kamu, role 'admin' akan diarahkan ke dashboard khusus
    if (Auth::user()->role === 'admin') {
        return redirect()->route('admin.dashboard');
    }
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// 3. Route Khusus Admin (Menggunakan Controller untuk Data Asli)
Route::middleware(['auth'])->group(function () {
    // Sekarang kita panggil AdminController@index untuk mengambil data user dari DB
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
});

// 4. Route Profile (Bawaan Laravel Breeze)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';