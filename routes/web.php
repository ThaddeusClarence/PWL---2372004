<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf; // IMPORT WAJIB UNTUK PDF

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

// 3. Route Khusus Admin & Fitur Export PDF
Route::middleware(['auth'])->group(function () {
    // Halaman Dashboard Admin Utama
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');

    // FITUR EXPORT PDF (Klik langsung download)
    Route::get('/admin/export-pdf', function () {
        // Ambil 20 user terbaru
        $recentUsers = User::latest()->take(20)->get();
        
        // Load view laporan.blade.php dan masukkan datanya
        $pdf = Pdf::loadView('admin.laporan', compact('recentUsers'));
        
        // Download file dengan nama ini
        return $pdf->download('Laporan_User_EventMaster.pdf');
    })->name('admin.export.pdf');
});

// 4. Route Profile (Bawaan Laravel Breeze)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';