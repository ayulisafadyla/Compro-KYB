<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\HandleImageUpload;

class EventController extends Controller
{
    use HandleImageUpload;

    /**
     * Display a listing of the resource.
     */
    public function index(\Illuminate\Http\Request $request)
    {
        $type = $request->get('type');
        $validTypes = ['launch', 'workshop', 'promo', 'exhibition'];

        if ($type && !in_array($type, $validTypes)) {
            return redirect()->route('admin.events.index');
        }

        $events = \App\Models\Event::query()
            ->when($type, function($query, $type) {
                return $query->where('type', $type);
            })
            ->latest()
            ->paginate(15);

        $titles = [
            'launch' => 'Daftar Events',
            'workshop' => 'Penghargaan',
            'promo' => 'Sertifikat',
            'exhibition' => 'Pameran',
        ];

        $title = $titles[$type] ?? 'Semua Acara & Event';

        return view('admin.events.index', compact('events', 'type', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $type = $request->get('type');
        return view('admin.events.create', compact('type'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:500',
            'content' => 'required|string',
            'date' => 'required|date',
            'type' => 'required|in:launch,workshop,promo,exhibition',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'is_published' => 'boolean',
        ]);

        $validated['slug'] = \Illuminate\Support\Str::slug($request->title) . '-' . time();
        $validated['is_published'] = $request->has('is_published');

        if ($request->hasFile('image')) {
            $validated['image'] = $this->uploadAndConvertToWebp($request->file('image'), 'events');
        }

        \App\Models\Event::create($validated);

        return redirect()->route('admin.events.index', ['type' => $request->type])
            ->with('success', 'Event created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(\App\Models\Event $event)
    {
        return view('admin.events.show', compact('event'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(\App\Models\Event $event)
    {
        return view('admin.events.edit', compact('event'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, \App\Models\Event $event)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:500',
            'content' => 'required|string',
            'date' => 'required|date',
            'type' => 'required|in:launch,workshop,promo,exhibition',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'is_published' => 'boolean',
        ]);

        if ($request->title !== $event->title) {
            $validated['slug'] = \Illuminate\Support\Str::slug($request->title) . '-' . time();
        }

        $validated['is_published'] = $request->has('is_published');

        if ($request->hasFile('image')) {
            $this->deleteImage($event->image);
            $validated['image'] = $this->uploadAndConvertToWebp($request->file('image'), 'events');
        }

        $event->update($validated);

        return redirect()->route('admin.events.index', ['type' => $request->type])
            ->with('success', 'Event updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(\App\Models\Event $event)
    {
        $this->deleteImage($event->image);

        $event->delete();

        return redirect()->back()
            ->with('success', 'Event deleted successfully.');
    }
}
