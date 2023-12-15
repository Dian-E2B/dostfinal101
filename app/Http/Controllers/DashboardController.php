<?php

namespace App\Http\Controllers;

use App\Models\Ongoing;
use Barryvdh\Debugbar\Facades\Debugbar;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class DashboardController extends Controller
{

    public function dashboardview()
    {
        if (empty($startYear) && empty($endYear)) {
            /* ScholarshipProgram */
            $ongoingPROGRAM = DB::table('ongoing')
                ->select('startyear', 'scholarshipprogram', DB::raw('COUNT(*) as scholarshipprogramcount'))
                ->whereNotNull('scholarshipprogram')
                ->groupBy('startyear', 'scholarshipprogram')
                ->get();

            $uniqueYears = $ongoingPROGRAM->pluck('startyear')->unique()->sort()->values();

            /* ScholarshipProgram Filter */
            $ongoingPROGRAMcounter = DB::table('ongoing')
                ->select('scholarshipprogram')
                ->selectRaw('COUNT(*) as scholarshipprogramcount')
                ->whereIn('scholarshipprogram', ['MERIT', 'RA 10612', 'RA 7687'])
                ->groupBy('scholarshipprogram')
                ->get();

            /* Gender */



            return view('dashboard', compact('ongoingPROGRAM', 'uniqueYears', 'ongoingPROGRAMcounter'));
        }
    }

    public function getprogramchartyearfilter(Request $request)
    {
        $startYear = $request->input('startyear');
        $endYear = $request->input('endyear');
        // Debugbar::info($startYear);


        if ($startYear) {
            $ongoingPROGRAM = DB::table('ongoing')
                ->select('startyear', 'scholarshipprogram', DB::raw('COUNT(*) as scholarshipprogramcount'))
                ->whereNotNull('scholarshipprogram')
                ->whereBetween('startyear', [$startYear, $endYear])

                ->groupBy('startyear', 'scholarshipprogram')
                ->get();

            $uniqueYears = $ongoingPROGRAM->pluck('startyear')->unique()->sort()->values();


            $ongoingPROGRAMcounter = DB::table('ongoing')
                ->select('scholarshipprogram')
                ->selectRaw('COUNT(*) as scholarshipprogramcount')
                ->whereIn('scholarshipprogram', ['MERIT', 'RA 10612', 'RA 7687'])
                ->whereBetween('startyear', [$startYear, $endYear])

                ->groupBy('scholarshipprogram')
                ->get();


            /* Debugbar::info($ongoingPROGRAMcounter); */
            return response()->json([
                'ongoingPROGRAM' => $ongoingPROGRAM,
                'uniqueYears' => $uniqueYears,
                'ongoingPROGRAMcounter' => $ongoingPROGRAMcounter,
                /* 'htmlContentprogram' => $htmlContentprogram */
            ]);
        } else {
            return response()->json([]);
        }
    }
}
