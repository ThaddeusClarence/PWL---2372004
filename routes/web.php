<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\OrganizerController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf; // IMPORT WAJIB UNTUK PDF

// 1. Halaman Utama (Tampilkan Event Terbaru)
Route::get('/', function () {
    $events = \App\Models\Event::latest()->take(6)->get();
    return view('welcome', compact('events'));
});

// Route Detail Event (Publik)
Route::get('/events/{event}', function (\App\Models\Event $event) {
    $event->load('ticketTypes');
    return view('events.show', compact('event'));
})->name('events.show');

// 2. Dashboard Logic (Otomatis Redirect sesuai Role)
Route::get('/dashboard', function () {
    $user = Auth::user();
    
    if ($user->role === 'admin') {
        return redirect()->route('admin.dashboard');
    } elseif ($user->role === 'organizer') {
        return redirect()->route('organizer.dashboard');
    } elseif ($user->role === 'customer') {
        return redirect()->route('customer.dashboard');
    }
    
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// 3. Route Khusus Admin, Organizer & Customer
Route::middleware(['auth'])->group(function () {
    // Dashboard Admin
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    
    // Manajemen Event (Admin)
    Route::resource('admin/events', EventController::class)->names([
        'index' => 'admin.events.index',
        'create' => 'admin.events.create',
        'store' => 'admin.events.store',
        'show' => 'admin.events.show',
        'edit' => 'admin.events.edit',
        'update' => 'admin.events.update',
        'destroy' => 'admin.events.destroy',
    ]);

    // Manajemen Ticket (Scan Simulation)
    Route::get('/scan', [AdminController::class, 'scanView'])->name('scan.view');
    Route::post('/scan', [AdminController::class, 'scanPerform'])->name('scan.perform');

    // Manajemen Organizer (Oleh Admin)
    Route::get('/admin/organizers', [AdminController::class, 'organizerIndex'])->name('admin.organizers.index');
    Route::get('/admin/organizers/create', [AdminController::class, 'organizerCreate'])->name('admin.organizers.create');
    Route::post('/admin/organizers', [AdminController::class, 'organizerStore'])->name('admin.organizers.store');
    Route::get('/admin/organizers/{user}', [AdminController::class, 'organizerShow'])->name('admin.organizers.show');
    Route::delete('/admin/organizers/{user}', [AdminController::class, 'organizerDestroy'])->name('admin.organizers.destroy');

    // Dashboard Organizer
    Route::get('/organizer/dashboard', [OrganizerController::class, 'index'])->name('organizer.dashboard');

    // Dashboard Customer
    Route::get('/customer/dashboard', [CustomerController::class, 'index'])->name('customer.dashboard');

    // FITUR TICKETING (Checkout)
    Route::post('/checkout', [\App\Http\Controllers\CheckoutController::class, 'store'])->name('checkout.store');
    Route::get('/checkout/success/{order}', [\App\Http\Controllers\CheckoutController::class, 'success'])->name('checkout.success');

    // FITUR EXPORT PDF
    Route::get('/admin/export-pdf', function () {
        // Ambil 20 user terbaru
        $recentUsers = User::latest()->take(20)->get();
        
        // Load view laporan.blade.php dan masukkan datanya
        $pdf = Pdf::loadView('admin.laporan', compact('recentUsers'));
        
        // Download file dengan nama ini
        return $pdf->download('Laporan_User_EventMaster.pdf');
    })->name('admin.export.pdf');

    // FITUR EXPORT EXCEL
    Route::get('/admin/export-excel', function () {
        return \Maatwebsite\Excel\Facades\Excel::download(new \App\Exports\SalesExport, 'Laporan_Penjualan_EventMaster.xlsx');
    })->name('admin.export.excel');
});

// 4. Route Profile (Bawaan Laravel Breeze)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';