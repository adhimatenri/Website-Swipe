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
    

   
    public function show(Jamaah $jamaah)
    {
        return view('backoffice.jamaah.show', compact('jamaah'));
    }
   
}
