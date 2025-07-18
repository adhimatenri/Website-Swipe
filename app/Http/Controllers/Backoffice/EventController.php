<?php
namespace App\Http\Controllers\Backoffice;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;
use Yajra\DataTables\Html\Builder;
use Illuminate\Support\Str;

class EventController extends Controller
{


    public function data(Request $request)
    {
        $query = Event::query(); 
    
        return DataTables::of($query)
            ->addIndexColumn()
            ->editColumn('datetime_start', fn ($e) => \Carbon\Carbon::parse($e->datetime_start)->format('d M Y H:i'))
            ->editColumn('datetime_end', fn ($e) => \Carbon\Carbon::parse($e->datetime_end)->format('d M Y H:i'))
            ->addColumn('status', fn ($e) => $e->is_active_event ? 'Aktif' : 'Tidak Aktif')
            ->addColumn('action', function ($e) {
                return view('backoffice.events.partials.action', compact('e'))->render();
            })
            ->rawColumns(['action', 'status'])
            ->make(true);
    }
    
        

    public function index()
    {
        return view('backoffice.events.index');
    }
    

    public function create()
    {
        return view('backoffice.events.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'nullable',
            'datetime_start' => 'required|date',
            'datetime_end' => 'required|date|after:datetime_start',
            'location' => 'nullable',
            'max_amount_participants' => 'nullable|integer|min:0',
            'poster' => 'nullable|image|mimes:jpg,jpeg,png|max:2048', // ✅ validasi file
        ]);

        $posterUrl = null;

        if ($request->hasFile('poster')) {
            $posterUrl = $request->file('poster')->store('posters', 'public');
        }

        Event::create([
            'id' => Str::uuid(),
            'title' => $request->title,
            'description' => $request->description,
            'datetime_start' => $request->datetime_start,
            'datetime_end' => $request->datetime_end,
            'location' => $request->location,
            'max_amount_participants' => $request->max_amount_participants ?? 0,
            'poster_url' => $posterUrl,
            'is_active_event' => $request->has('is_active_event'),
            'created_by' => auth()->id(),
        ]);

        return redirect()->route('backoffice.events.index')->with('success', 'Data Event Berhasil Ditambahkan');
    }

    public function edit(Event $event)
    {
        return view('backoffice.events.edit', compact('event'));
    }
    

    public function update(Request $request, Event $event)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'nullable',
            'datetime_start' => 'required|date',
            'datetime_end' => 'required|date|after:datetime_start',
            'location' => 'nullable',
            'max_amount_participants' => 'nullable|integer|min:0',
            'poster' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('poster')) {
            $posterUrl = $request->file('poster')->store('posters', 'public');
            $event->poster_url = $posterUrl;
        }

        $event->update([
            'title' => $request->title,
            'description' => $request->description,
            'datetime_start' => $request->datetime_start,
            'datetime_end' => $request->datetime_end,
            'location' => $request->location,
            'max_amount_participants' => $request->max_amount_participants ?? 0,
            'is_active_event' => $request->has('is_active_event'),
            'updated_by' => auth()->id(),
        ]);

        return redirect()->route('backoffice.events.index')->with('success', 'Data Event Berhasil Diperbaharui');
    }
    public function show(Event $event)
    {
        return view('backoffice.events.show', compact('event'));
    }
    public function destroy(Event $event)
    {
        $event->delete();
        return response()->json(['success' => true]);
    }
}
