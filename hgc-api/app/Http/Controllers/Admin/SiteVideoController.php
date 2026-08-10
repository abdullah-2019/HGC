<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteVideo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class SiteVideoController extends Controller
{
    public function index()
    {
        $videos = SiteVideo::orderByDesc('created_at')->get();
        return view('admin.videos.index', compact('videos'));
    }

    public function create()
    {
        return view('admin.videos.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'video_file' => 'nullable|file|mimes:mp4,webm,ogg|max:51200',
            'video_url' => 'nullable|string|max:500',
            'is_active' => 'boolean',
        ]);

        if ($request->hasFile('video_file')) {
            $file = $request->file('video_file');
            $ext = $file->getClientOriginalExtension();
            $name = Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . '-' . time();
            $validated['video_file'] = $file->storeAs('uploads', $name . '.' . $ext, 'public');
        }

        $validated['is_active'] = $request->boolean('is_active', false);

        SiteVideo::create($validated);

        return redirect()->route('admin.videos.index')->with('success', 'Video saved.');
    }

    public function edit(SiteVideo $video)
    {
        return view('admin.videos.edit', compact('video'));
    }

    public function update(Request $request, SiteVideo $video)
    {
        $validated = $request->validate([
            'video_file' => 'nullable|file|mimes:mp4,webm,ogg|max:51200',
            'video_url' => 'nullable|string|max:500',
            'is_active' => 'boolean',
        ]);

        if ($request->hasFile('video_file')) {
            if ($video->video_file && Storage::disk('public')->exists($video->video_file)) {
                Storage::disk('public')->delete($video->video_file);
            }
            $file = $request->file('video_file');
            $ext = $file->getClientOriginalExtension();
            $name = Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . '-' . time();
            $validated['video_file'] = $file->storeAs('uploads', $name . '.' . $ext, 'public');
        } else {
            unset($validated['video_file']);
        }

        $validated['is_active'] = $request->boolean('is_active', false);

        $video->update($validated);

        return redirect()->route('admin.videos.index')->with('success', 'Video updated.');
    }

    public function destroy(SiteVideo $video)
    {
        if ($video->video_file && Storage::disk('public')->exists($video->video_file)) {
            Storage::disk('public')->delete($video->video_file);
        }
        $video->delete();
        return redirect()->route('admin.videos.index')->with('success', 'Video deleted.');
    }
}