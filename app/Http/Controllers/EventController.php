<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    /**
     * Display the event landing page.
     */
    public function show(string $slug)
    {
        $event = Event::where('slug', $slug)->firstOrFail();
        return view('events.show', compact('event'));
    }
}
