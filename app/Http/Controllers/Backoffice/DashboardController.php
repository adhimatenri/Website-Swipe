<?php

namespace App\Http\Controllers\Backoffice;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $year = $request->get('year', now()->year);

        $monthlyData = \DB::table('events')
            ->selectRaw('EXTRACT(MONTH FROM datetime_end) as month, COUNT(*) as total')
            ->whereYear('datetime_end', $year)
            ->groupByRaw('EXTRACT(MONTH FROM datetime_end)')
            ->pluck('total', 'month')
            ->toArray();

        $monthlyDataFull = [];
        for ($i = 1; $i <= 12; $i++) {
            $monthlyDataFull[] = $monthlyData[$i] ?? 0;
        }
        
        $upcomingEvents = \DB::table('events')
        ->where('datetime_start', '>=', now())
        ->orderBy('datetime_start', 'asc')
        ->take(5)
        ->get();

        $eventSelesai = \DB::table('events')->where('datetime_end', '<', now())->count();
        $eventMendatang = \DB::table('events')->where('datetime_start', '>=', now())->count();
    

        return view('backoffice.dashboard', [
            'year' => $year,
            'monthlyData' => $monthlyDataFull,
            'eventBerlangsung' => $eventMendatang,
            'eventSelesai' => $eventSelesai,
            'totalEvent' => \DB::table('events')->count(),
            'jumlahJamaah' => \DB::table('jamaah')->count(),
            'totalEventActive' => $eventSelesai + $eventMendatang,
            'upcomingEvents' => \DB::table('events')
                ->where('datetime_start', '>=', now())
                ->orderBy('datetime_start')
                ->limit(5)
                ->get()
        ]);
    }

    public function chartData(Request $request)
    {
        $year = $request->get('year', now()->year);

        $eventsPerMonth = DB::table('events')
            ->select(DB::raw('EXTRACT(MONTH FROM datetime_end) as month'), DB::raw('COUNT(*) as total'))
            ->whereYear('datetime_end', $year)
            ->groupBy(DB::raw('EXTRACT(MONTH FROM datetime_end)'))
            ->pluck('total', 'month')
            ->toArray();

        $monthlyData = [];
        for ($i = 1; $i <= 12; $i++) {
            $monthlyData[] = $eventsPerMonth[$i] ?? 0;
        }

        return response()->json([
            'monthlyData' => $monthlyData
        ]);
    }


}

