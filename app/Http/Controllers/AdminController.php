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

        $totalRevenue = \App\Models\Order::where('status', 'paid')->sum('total_price');
        $totalTickets = \App\Models\Ticket::count();
        $activeEvents = \App\Models\Event::count();

        return view('admin.dashboard', compact(
            'totalUsers', 
            'totalAdmin', 
            'totalOrganizer', 
            'totalCustomer',
            'totalRevenue',
            'totalTickets',
            'activeEvents',
            'recentUsers'
        ));
    }

    /**
     * Fungsi untuk menampilkan halaman laporan siap cetak
     */
    public function scanView()
    {
        return view('admin.scan');
    }

    public function scanPerform(Request $request)
    {
        $request->validate(['ticket_code' => 'required|string']);

        $ticket = \App\Models\Ticket::where('ticket_code', $request->ticket_code)->first();

        if (!$ticket) {
            return back()->with('error', 'Tiket TIDAK DITEMUKAN! Periksa kembali kode.');
        }

        if ($ticket->is_used) {
            return back()->with('error', 'Tiket SUDAH DIGUNAKAN pada ' . $ticket->updated_at->format('d M H:i'));
        }

        $ticket->update(['is_used' => true]);

        return back()->with('success', 'VALID! Tiket berhasil diverifikasi.')
                    ->with('owner_name', $ticket->user->name)
                    ->with('ticket_type', $ticket->ticketType->name);
    }

    /**
     * Manajemen Organizer Oleh Admin
     */
    public function organizerIndex()
    {
        $organizers = User::where('role', 'organizer')->latest()->get();
        return view('admin.organizers.index', compact('organizers'));
    }

    public function organizerCreate()
    {
        return view('admin.organizers.create');
    }

    public function organizerStore(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => \Illuminate\Support\Facades\Hash::make($request->password),
            'password_plain' => $request->password, // Simpan teks asli untuk demo
            'role' => 'organizer',
        ]);

        return redirect()->route('admin.organizers.index')->with('success', 'Akun Organizer berhasil dibuat oleh Admin!');
    }

    public function organizerDestroy($id)
    {
        $user = User::findOrFail($id);
        
        if ($user->role !== 'organizer') {
            return back()->with('error', 'Hanya akun organizer yang dapat dihapus dari sini.');
        }

        $user->delete();

        return redirect()->route('admin.organizers.index')->with('success', 'Akun Organizer berhasil dihapus!');
    }

    public function organizerEdit($id)
    {
        $organizer = User::findOrFail($id);
        
        if ($organizer->role !== 'organizer') {
            return redirect()->route('admin.organizers.index')->with('error', 'Pengguna bukan seorang organizer.');
        }

        return view('admin.organizers.edit', compact('organizer'));
    }

    public function organizerUpdate(Request $request, $id)
    {
        $user = User::findOrFail($id);
        
        if ($user->role !== 'organizer') {
            return redirect()->route('admin.organizers.index')->with('error', 'Pengguna bukan seorang organizer.');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'.$user->id,
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
        ];

        if ($request->filled('password')) {
            $data['password'] = \Illuminate\Support\Facades\Hash::make($request->password);
            $data['password_plain'] = $request->password; // Simpan teks asli untuk demo sesuai pola yang ada
        }

        $user->update($data);

        return redirect()->route('admin.organizers.index')->with('success', 'Akun Organizer berhasil diperbarui!');
    }

    public function organizerShow($id)
    {
        $organizer = User::findOrFail($id);
        
        if ($organizer->role !== 'organizer') {
            return redirect()->route('admin.organizers.index')->with('error', 'Pengguna bukan seorang organizer.');
        }

        // Statistik Tambahan untuk Detail
        $stats = [
            'total_events' => \App\Models\Event::where('user_id', $organizer->id)->count(),
            'total_sales' => \App\Models\Ticket::whereHas('ticketType.event', function($q) use ($organizer) {
                $q->where('user_id', $organizer->id);
            })->count(),
        ];

        return view('admin.organizers.show', compact('organizer', 'stats'));
    }

    /**
     * Manajemen Customer Oleh Admin
     */
    public function customerIndex()
    {
        $customers = User::where('role', 'customer')->latest()->get();
        return view('admin.customers.index', compact('customers'));
    }

    public function customerDestroy($id)
    {
        $user = User::findOrFail($id);
        
        if ($user->role !== 'customer') {
            return back()->with('error', 'Hanya akun customer yang dapat dihapus dari sini.');
        }

        $user->delete();

        return redirect()->route('admin.customers.index')->with('success', 'Akun Customer berhasil dihapus!');
    }

    public function customerShow($id)
    {
        $customer = User::findOrFail($id);
        
        if ($customer->role !== 'customer') {
            return redirect()->route('admin.customers.index')->with('error', 'Pengguna bukan seorang customer.');
        }

        // Ambil riwayat pembelian
        $orders = \App\Models\Order::where('user_id', $customer->id)
            ->with(['event', 'tickets'])
            ->latest()
            ->get();

        return view('admin.customers.show', compact('customer', 'orders'));
    }

    public function customerUpdatePassword(Request $request, $id)
    {
        $request->validate([
            'new_password' => 'required|string|min:8',
        ]);

        $user = User::findOrFail($id);
        $user->update([
            'password' => \Illuminate\Support\Facades\Hash::make($request->new_password),
            'password_plain' => $request->new_password,
        ]);

        return back()->with('success', 'Password customer berhasil diperbarui!');
    }

    public function updateOrderStatus(Request $request, $id)
    {
        $order = \App\Models\Order::findOrFail($id);
        $order->update(['status' => $request->status]);

        return back()->with('success', 'Status pesanan #' . $id . ' berhasil diubah menjadi ' . strtoupper($request->status));
    }

    public function waitingListIndex()
    {
        $waitingLists = \App\Models\WaitingList::with(['user', 'event'])->latest()->get();
        return view('admin.waiting-list.index', compact('waitingLists'));
    }

    public function waitingListDestroy($id)
    {
        \App\Models\WaitingList::findOrFail($id)->delete();
        return back()->with('success', 'Data antrean berhasil dihapus!');
    }

    public function ticketsIndex()
    {
        $tickets = \App\Models\Ticket::with(['user', 'ticketType.event'])->latest()->paginate(20);
        return view('admin.tickets.index', compact('tickets'));
    }

    public function ticketDestroy($id)
    {
        \App\Models\Ticket::findOrFail($id)->delete();
        return back()->with('success', 'Tiket berhasil "disobek" (dihapus dari sistem).');
    }
}