<?php

namespace App\Http\Controllers\Event;

use App\Models\Event;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Jamaah;
use App\Models\EventRegistrations;
use Illuminate\Support\Facades\Auth;

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

    /**
     * Handle event registration.
     */
    public function register(Request $request, string $slug)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'dob' => 'required|date',
            'gender' => 'required|string|in:Akhwat,Ikhwan',
            'phone' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'address' => 'required|string',
        ]);

        $event = Event::where('slug', $slug)->firstOrFail();

        $jamaah =             
            Jamaah::where('email', $request->email)
            ->orWhere('phone', $request->phone)
            ->first();
        if (! $jamaah) {
            $jamaah = Jamaah::create([
                'name' => $request->name,
                'dob' => $request->dob,
                'gender' => $request->gender,
                'phone' => $request->phone,
                'email' => $request->email,
                'address' => $request->address
            ]);
        }

        $registration = EventRegistrations::create([
            'event_id' => $event->id,
            'jamaah_id' => $jamaah->id
        ]);

        // Return JSON payload for AJAX
        return response()->json([ 'registrationId' => $registration->id ]);
    }
}
