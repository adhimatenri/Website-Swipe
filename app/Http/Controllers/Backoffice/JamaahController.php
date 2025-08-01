<?php
namespace App\Http\Controllers\Backoffice;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Jamaah;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;
use Yajra\DataTables\Html\Builder;
use Illuminate\Support\Str;

class JamaahController extends Controller
{


    public function data(Request $request)
    {
        $query = Jamaah::query(); 
    
        return DataTables::of($query)
            ->addIndexColumn()
            ->editColumn('created_at', fn ($e) => \Carbon\Carbon::parse($e->datetime_start)->format('d M Y H:i'))
            ->addColumn('action', function ($e) {
                return view('backoffice.jamaah.partials.action', compact('e'))->render();
            })
            ->rawColumns(['action', 'status'])
            ->make(true);
    }
    
        

    public function index()
    {
        return view('backoffice.jamaah.index');
    }
    

   
    public function show($id)
    {
        $jamaah = Jamaah::findOrFail($id);
    
        $events = \DB::table('event_registrations as er')
            ->join('events as e', 'e.id', '=', 'er.event_id')
            ->leftJoin('event_attendances as ea', 'ea.registration_id', '=', 'er.id')
            ->select(
                'e.id as event_id',
                'e.title as event_name',
                'e.poster_url',
                'er.createdAt as registered_at',
                'ea.check_in_at'
            )
            ->where('er.jamaah_id', $id)
            ->orderBy('er.createdAt', 'desc')
            ->get();
    
        $jumlahEvent = $events->count();
    
        return view('backoffice.jamaah.show', compact('jamaah', 'events', 'jumlahEvent'));
    }
    
   
}
