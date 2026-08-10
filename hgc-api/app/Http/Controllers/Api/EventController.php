<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    private function resolveField($event, string $field, string $lang)
    {
        $val = $event->{"{$field}_{$lang}"};
        if (!empty($val)) return $val;
        $val = $event->{"{$field}_en"};
        if (!empty($val)) return $val;
        foreach (['en', 'dari', 'pashto'] as $l) {
            $val = $event->{"{$field}_{$l}"};
            if (!empty($val)) return $val;
        }
        return null;
    }

    private function resolveImage($event)
    {
        if (empty($event->cover_image)) return null;
        if (str_starts_with($event->cover_image, 'http')) return $event->cover_image;
        return asset('storage/' . ltrim($event->cover_image, '/'));
    }

    public function index(Request $request)
    {
        $lang = $request->query('lang', 'en');
        if (!in_array($lang, ['en', 'dari', 'pashto'])) $lang = 'en';

        $events = Event::where('is_published', true)
            ->orderBy('event_date')
            ->get()
            ->map(function ($event) use ($lang) {
                return [
                    'id' => $event->id,
                    'slug' => $event->slug,
                    'title' => $this->resolveField($event, 'title', $lang),
                    'description' => $this->resolveField($event, 'description', $lang) ?? '',
                    'location' => $this->resolveField($event, 'location', $lang) ?? '',
                    'event_date' => $event->event_date->toDateString(),
                    'event_time' => $event->event_time,
                    'cover_image' => $this->resolveImage($event),
                    'is_upcoming' => $event->event_date >= now()->toDateString(),
                ];
            });

        return response()->json(['success' => true, 'data' => $events]);
    }

    public function show(Request $request, $slug)
    {
        $lang = $request->query('lang', 'en');
        if (!in_array($lang, ['en', 'dari', 'pashto'])) $lang = 'en';

        $event = Event::where('slug', $slug)->where('is_published', true)->first();

        if (!$event) {
            return response()->json(['success' => false, 'message' => 'Not found'], 404);
        }

        return response()->json([
            'success' => true,
            'data' => [
                'id' => $event->id,
                'slug' => $event->slug,
                'title' => $this->resolveField($event, 'title', $lang),
                'description' => $this->resolveField($event, 'description', $lang) ?? '',
                'location' => $this->resolveField($event, 'location', $lang) ?? '',
                'event_date' => $event->event_date->toDateString(),
                'event_time' => $event->event_time,
                'cover_image' => $this->resolveImage($event),
                'is_upcoming' => $event->event_date >= now()->toDateString(),
            ]
        ]);
    }
}