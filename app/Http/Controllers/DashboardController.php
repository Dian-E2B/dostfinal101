<?php

namespace App\Http\Controllers;

use App\Models\Ongoing;
use Barryvdh\Debugbar\Facades\Debugbar;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class DashboardController extends Controller
{

    public function dashboardview(Request $request)
    {
        $startYear = $request->input('startyear');
        $endYear = $request->input('endyear');

        $allowedSchools = ['ADDU', 'BROKENSHIRE COLLEGE', 'DDC', 'SPC', 'UIC', 'UM-Matina', 'UP Mindanao', 'USEP Mintal', 'USEP-Obrero'];
        if (empty($startYear) && empty($endYear)) {

            //SCHOLARSHIPPROGRAM
            $ongoingPROGRAM = DB::table('ongoing')
                ->select('startyear', 'scholarshipprogram', DB::raw('COUNT(*) as scholarshipprogramcount'))
                ->whereNotNull('scholarshipprogram')
                ->groupBy('startyear', 'scholarshipprogram')
                ->get();

            $uniqueYears = $ongoingPROGRAM->pluck('startyear')->unique()->sort()->values();

            return view('dashboard', compact('ongoingPROGRAM', 'uniqueYears'));
        } else {

            return view('dashboard', compact('schoolCounts', 'ongoingPROGRAM', 'ongoingCOURSE'));
        }




        // Debugbar::info($ongoingRecords);
    }
}
