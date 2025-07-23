<?php

namespace App\Http\Controllers\Event;

use App\Models\Event;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EventController extends Controller
{
    /**
     * Display a listing of the active events.
     */
    public function index()
    {
        $events = Event::where('is_active_event', true)
            ->where('datetime_end', '>', now())
            ->orderBy('datetime_start', 'asc')
            ->get();
        return view('event.index', compact('events'));
    }

    /**
     * Display the event landing page.
     */
    public function show(string $slug)
    {
        $event = Event::where('slug', $slug)->firstOrFail();
        return view('event.show', compact('event'));
    }
}
