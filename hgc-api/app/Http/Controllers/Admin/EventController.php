<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::orderBy('event_date')->get();
        return view('admin.events.index', compact('events'));
    }

    public function create()
    {
        return view('admin.events.create');
    }

    private function generateSlug(string $title): string
    {
        $slug = Str::slug($title, '_');
        $original = $slug;
        $counter = 1;
        while (Event::where('slug', $slug)->exists()) {
            $slug = $original . '_' . $counter++;
        }
        return $slug;
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title_en' => 'required|string|max:200',
            'title_dari' => 'nullable|string|max:200',
            'title_pashto' => 'nullable|string|max:200',
            'description_en' => 'nullable|string',
            'description_dari' => 'nullable|string',
            'description_pashto' => 'nullable|string',
            'location_en' => 'nullable|string|max:255',
            'location_dari' => 'nullable|string|max:255',
            'location_pashto' => 'nullable|string|max:255',
            'event_date' => 'required|date',
            'event_time' => 'nullable|string|max:100',
            'is_published' => 'boolean',
            'cover_image_file' => 'nullable|image|mimes:webp,jpg,jpeg,png|max:2048',
        ]);

        $validated['slug'] = $this->generateSlug($request->title_en);

        if ($request->hasFile('cover_image_file')) {
            $file = $request->file('cover_image_file');
            $ext = $file->getClientOriginalExtension();
            $name = Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . '-' . time();
            $validated['cover_image'] = $file->storeAs('uploads', $name . '.' . $ext, 'public');
        }

        $validated['is_published'] = $request->boolean('is_published', false);

        Event::create($validated);

        return redirect()->route('admin.events.index')->with('success', 'Event created successfully.');
    }

    public function edit(Event $event)
    {
        return view('admin.events.edit', compact('event'));
    }

    public function update(Request $request, Event $event)
    {
        $validated = $request->validate([
            'title_en' => 'required|string|max:200',
            'title_dari' => 'nullable|string|max:200',
            'title_pashto' => 'nullable|string|max:200',
            'description_en' => 'nullable|string',
            'description_dari' => 'nullable|string',
            'description_pashto' => 'nullable|string',
            'location_en' => 'nullable|string|max:255',
            'location_dari' => 'nullable|string|max:255',
            'location_pashto' => 'nullable|string|max:255',
            'event_date' => 'required|date',
            'event_time' => 'nullable|string|max:100',
            'is_published' => 'boolean',
            'cover_image_file' => 'nullable|image|mimes:webp,jpg,jpeg,png|max:2048',
        ]);

        if ($request->title_en !== $event->title_en) {
            $validated['slug'] = $this->generateSlug($request->title_en);
        }

        if ($request->hasFile('cover_image_file')) {
            if ($event->cover_image && Storage::disk('public')->exists($event->cover_image)) {
                Storage::disk('public')->delete($event->cover_image);
            }
            $file = $request->file('cover_image_file');
            $ext = $file->getClientOriginalExtension();
            $name = Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . '-' . time();
            $validated['cover_image'] = $file->storeAs('uploads', $name . '.' . $ext, 'public');
        } else {
            unset($validated['cover_image']);
        }

        $validated['is_published'] = $request->boolean('is_published', false);

        $event->update($validated);

        return redirect()->route('admin.events.index')->with('success', 'Event updated successfully.');
    }

    public function destroy(Event $event)
    {
        if ($event->cover_image && Storage::disk('public')->exists($event->cover_image)) {
            Storage::disk('public')->delete($event->cover_image);
        }
        $event->delete();
        return redirect()->route('admin.events.index')->with('success', 'Event deleted successfully.');
    }
}