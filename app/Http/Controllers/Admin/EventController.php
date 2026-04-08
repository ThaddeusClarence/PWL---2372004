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
        return view('admin.events.create', compact('organizers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'banner' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'category' => 'required|string',
            'location' => 'required|string',
            'date' => 'required|date',
            'start_time' => 'required',
            'ticket_names' => 'required|array',
            'ticket_prices' => 'required|array',
            'ticket_quotas' => 'required|array',
            'organizer_id' => 'nullable|exists:users,id',
        ]);

        $data = $request->only(['title', 'description', 'category', 'location', 'date', 'start_time', 'organizer_id']);
        $data['user_id'] = Auth::id();

        // Calculate summary fields
        $data['price'] = min($request->ticket_prices);
        $data['quota'] = array_sum($request->ticket_quotas);

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
        return view('admin.events.edit', compact('event', 'organizers'));
    }

    public function update(Request $request, Event $event)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string',
            'location' => 'required|string',
            'date' => 'required|date',
            'start_time' => 'required',
            'ticket_ids' => 'required|array',
            'ticket_names' => 'required|array',
            'ticket_prices' => 'required|array',
            'ticket_quotas' => 'required|array',
            'organizer_id' => 'nullable|exists:users,id',
        ]);

        $data = $request->only(['title', 'category', 'location', 'date', 'start_time', 'organizer_id']);

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

        // 2. Update Masing-masing Kategori Tiket
        foreach ($request->ticket_ids as $index => $id) {
            $ticketType = \App\Models\TicketType::findOrFail($id);
            
            // Logika penyesuaian remaining_quota
            // Jika kuota ditambah 10, maka sisa tiket juga ditambah 10
            $diff = $request->ticket_quotas[$index] - $ticketType->quota;
            
            $ticketType->update([
                'name' => $request->ticket_names[$index],
                'price' => $request->ticket_prices[$index],
                'quota' => $request->ticket_quotas[$index],
                'remaining_quota' => $ticketType->remaining_quota + $diff,
            ]);
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
