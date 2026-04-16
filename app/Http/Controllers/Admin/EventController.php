<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::latest()->paginate(10);
        return view('admin.events.index', compact('events'));
    }

    public function create()
    {
        $organizers = User::where('role', 'organizer')->get();
        $categories = \App\Models\Category::all();
        return view('admin.events.create', compact('organizers', 'categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'banner' => 'nullable|file', // Diperbolehkan file apa saja tanpa batas ukuran (tergantung limit server)
            'category_id' => 'required|exists:categories,id',
            'location' => 'required|string',
            'date' => 'required|date',
            'start_time' => 'required',
            'end_time' => 'required',
            'ticket_names' => 'required|array|min:1',
            'ticket_names.*' => 'required|string',
            'ticket_prices' => 'required|array|min:1',
            'ticket_prices.*' => 'required|numeric|min:0',
            'ticket_quotas' => 'required|array|min:1',
            'ticket_quotas.*' => 'required|integer|min:0',
            'organizer_id' => 'nullable|exists:users,id',
        ]);

        $data = $request->only(['title', 'description', 'category_id', 'location', 'date', 'start_time', 'end_time', 'organizer_id']);
        $data['user_id'] = Auth::id();
        
        // Simpan juga string kategori lama agar tidak error di bagian lain yang masih pakai string
        $category = \App\Models\Category::find($request->category_id);
        $data['category'] = $category ? $category->name : 'Lainnya';

        // Calculate summary fields
        $data['price'] = count($request->ticket_prices) > 0 ? min($request->ticket_prices) : 0;
        $data['quota'] = count($request->ticket_quotas) > 0 ? array_sum($request->ticket_quotas) : 0;

        if ($request->hasFile('banner')) {
            $data['banner'] = $request->file('banner')->store('events/banners', 'public');
        }

        $event = Event::create($data);

        // Create Ticket Types
        foreach ($request->ticket_names as $index => $name) {
            $event->ticketTypes()->create([
                'name' => $name,
                'price' => $request->ticket_prices[$index],
                'quota' => $request->ticket_quotas[$index],
                'remaining_quota' => $request->ticket_quotas[$index],
            ]);
        }

        return redirect()->route('admin.events.index')->with('success', 'Event berhasil dibuat dengan tipe tiket!');
    }

    public function edit(Event $event)
    {
        $organizers = User::where('role', 'organizer')->get();
        $categories = \App\Models\Category::all();
        return view('admin.events.edit', compact('event', 'organizers', 'categories'));
    }

    public function update(Request $request, Event $event)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'banner' => 'nullable|file', // Diperbolehkan file apa saja tanpa batas ukuran
            'category_id' => 'required|exists:categories,id',
            'location' => 'required|string',
            'date' => 'required|date',
            'start_time' => 'required',
            'end_time' => 'required',
            'ticket_ids' => 'nullable|array',
            'ticket_names' => 'required|array|min:1',
            'ticket_names.*' => 'required|string',
            'ticket_prices' => 'required|array|min:1',
            'ticket_prices.*' => 'required|numeric|min:0',
            'ticket_quotas' => 'required|array|min:1',
            'ticket_quotas.*' => 'required|integer|min:0',
            'organizer_id' => 'nullable|exists:users,id',
        ]);

        $data = $request->only(['title', 'description', 'category_id', 'location', 'date', 'start_time', 'end_time', 'organizer_id']);
        
        // Update string kategori lama
        $category = \App\Models\Category::find($request->category_id);
        $data['category'] = $category ? $category->name : 'Lainnya';

        // Update Ticket Types & Calculate Summary
        $newTotalQuota = array_sum($request->ticket_quotas);
        $newMinPrice = min($request->ticket_prices);

        $data['quota'] = $newTotalQuota;
        $data['price'] = $newMinPrice;

        if ($request->hasFile('banner')) {
            if ($event->banner) {
                Storage::disk('public')->delete($event->banner);
            }
            $data['banner'] = $request->file('banner')->store('events/banners', 'public');
        }

        // 1. Update Tabel Event
        $event->update($data);

        // 2. Sync Ticket Types
        // Delete tickets that are NOT in the submitted ticket_ids
        $submittedIds = $request->ticket_ids ?? [];
        $event->ticketTypes()->whereNotIn('id', $submittedIds)->delete();

        // Update or Create ticket types
        foreach ($request->ticket_names as $index => $name) {
            $id = $request->ticket_ids[$index] ?? null;
            
            if ($id) {
                $ticketType = \App\Models\TicketType::findOrFail($id);
                
                // Logika penyesuaian remaining_quota
                $diff = $request->ticket_quotas[$index] - $ticketType->quota;
                
                $ticketType->update([
                    'name' => $name,
                    'price' => $request->ticket_prices[$index],
                    'quota' => $request->ticket_quotas[$index],
                    'remaining_quota' => max(0, $ticketType->remaining_quota + $diff),
                ]);
            } else {
                // New Ticket Type added during edit
                $event->ticketTypes()->create([
                    'name' => $name,
                    'price' => $request->ticket_prices[$index],
                    'quota' => $request->ticket_quotas[$index],
                    'remaining_quota' => $request->ticket_quotas[$index],
                ]);
            }
        }

        return redirect()->route('admin.events.index')->with('success', 'Event dan Kategori Tiket berhasil diperbarui!');
    }

    public function destroy(Event $event)
    {
        if ($event->banner) {
            Storage::disk('public')->delete($event->banner);
        }
        $event->delete();

        return redirect()->route('admin.events.index')->with('success', 'Event berhasil dihapus!');
    }
}
