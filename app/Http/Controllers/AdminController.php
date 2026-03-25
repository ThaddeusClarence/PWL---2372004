<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        // Mengambil data statistik dari database
        $totalUsers = User::count();
        $totalAdmin = User::where('role', 'admin')->count();
        $totalOrganizer = User::where('role', 'organizer')->count();
        $totalCustomer = User::where('role', 'customer')->count();

        // Mengambil 5 pengguna terbaru untuk tabel di dashboard
        $recentUsers = User::latest()->take(5)->get();

        // Placeholder untuk tabel yang belum ada di SQL saat ini
        $totalRevenue = 0; 
        $activeEvents = 0;

        return view('admin.dashboard', compact(
            'totalUsers', 
            'totalAdmin', 
            'totalOrganizer', 
            'totalCustomer',
            'totalRevenue',
            'activeEvents',
            'recentUsers'
        ));
    }

    /**
     * Fungsi untuk menampilkan halaman laporan siap cetak
     */
    public function printLaporan()
    {
        // Mengambil 100 data user terbaru
        $recentUsers = User::latest()->take(100)->get(); 

        // Mengarahkan ke file view laporan
        return view('admin.laporan', compact('recentUsers'));
    }
}