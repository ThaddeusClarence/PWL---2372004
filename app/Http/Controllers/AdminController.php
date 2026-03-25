<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        // Mengambil data asli dari database
        $totalUsers = User::count();
        $totalAdmin = User::where('role', 'admin')->count();
        $totalOrganizer = User::where('role', 'organizer')->count();
        $totalCustomer = User::where('role', 'customer')->count();

        // Karena tabel Event & Transaksi belum ada di SQL kamu, 
        // kita set 0 dulu agar tidak error, tapi ini sudah terhubung ke logic DB
        $totalRevenue = 0; 
        $activeEvents = 0;

        return view('admin.dashboard', compact(
            'totalUsers', 
            'totalAdmin', 
            'totalOrganizer', 
            'totalCustomer',
            'totalRevenue',
            'activeEvents'
        ));
    }
}