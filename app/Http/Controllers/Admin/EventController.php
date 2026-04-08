<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;
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
        return view('admin.events.create');
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
        ]);

        $data = $request->only(['title', 'description', 'category', 'location', 'date', 'start_time']);
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
        return view('admin.events.edit', compact('event'));
    }

    public function update(Request $request, Event $event)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string',
            'location' => 'required|string',
            'date' => 'required|date',
            'start_time' => 'required',
            'quota' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
        ]);

        $data = $request->all();

        if ($request->hasFile('banner')) {
            // Hapus banner lama
            if ($event->banner) {
                Storage::disk('public')->delete($event->banner);
            }
            $data['banner'] = $request->file('banner')->store('events/banners', 'public');
        }

        $event->update($data);

        return redirect()->route('admin.events.index')->with('success', 'Event berhasil diperbarui!');
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
