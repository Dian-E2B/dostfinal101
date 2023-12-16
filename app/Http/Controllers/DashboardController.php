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


            /* $ongoingPROGRAM = Ongoing::select('startyear', 'endyear', 'MF', \DB::raw('COUNT(*) AS MFcount'))
                ->whereNotNull('MF')
                ->groupBy('startyear', 'endyear', 'MF')
                ->get(); */

            $uniqueYears = $ongoingPROGRAM->pluck('startyear')->unique()->sort()->values(); /* For filter */




            /* ScholarshipProgram Filter */
            $ongoingPROGRAMcounter = DB::table('ongoing')
                ->select('scholarshipprogram')
                ->selectRaw('COUNT(*) as scholarshipprogramcount')
                ->whereIn('scholarshipprogram', ['MERIT', 'RA 10612', 'RA 7687'])
                ->groupBy('scholarshipprogram')
                ->get();

            /* Gender */
            $ongoingGender = DB::table('ongoing')
                ->select('startyear', 'MF', DB::raw('COUNT(*) as MFcount'))
                ->whereNotNull('MF')
                ->groupBy('startyear', 'MF')
                ->get();

            $ongoingGendercounter = DB::table('ongoing')
                ->select('MF')
                ->selectRaw('COUNT(*) as MFcount')
                ->whereIn('MF', ['F', 'M'])
                ->groupBy('MF')
                ->get();

            /* ongGoingCourses */
            $courses = Ongoing::select('course', DB::raw('count(*) as courseCount'))
                ->whereNotNull('course')
                ->where('course', '<>', '')
                ->groupBy('course')
                ->get();
            $dataCourses = [
                'labelscourses' => $courses->pluck('course'),
                'datascourses' => $courses->pluck('courseCount'),
            ];


            return view('dashboard', compact(
                'ongoingPROGRAM',
                'uniqueYears',
                'ongoingPROGRAMcounter',
                'ongoingGender',
                'ongoingGendercounter',
                'dataCourses',
            ));
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

            $ongoingPROGRAMcounter = DB::table('ongoing')
                ->select('scholarshipprogram')
                ->selectRaw('COUNT(*) as scholarshipprogramcount')
                ->whereIn('scholarshipprogram', ['MERIT', 'RA 10612', 'RA 7687'])
                ->whereBetween('startyear', [$startYear, $endYear])
                ->groupBy('scholarshipprogram')
                ->get();

            return response()->json([
                'ongoingPROGRAM' => $ongoingPROGRAM,
                'ongoingPROGRAMcounter' => $ongoingPROGRAMcounter,
            ]);
        } else {
            // Debugbar::info($ongoingPROGRAMcounter);
            return response()->json([]);
        }
    }


    public function getgenderchartyearfilter(Request $request)
    {
        $startYear = $request->input('startyeargender');
        $endYear = $request->input('endyeargender');

        if ($startYear) {
            $ongoingGender = DB::table('ongoing')
                ->select('startyear', 'MF', DB::raw('COUNT(*) as MFcount'))
                ->whereNotNull('MF')
                ->whereBetween('startyear', [$startYear, $endYear])
                ->groupBy('startyear', 'MF')
                ->get();

            $ongoingGendercounter = DB::table('ongoing')
                ->select('MF')
                ->selectRaw('COUNT(*) as MFcount')
                ->whereIn('MF', ['F', 'M'])
                ->whereBetween('startyear', [$startYear, $endYear])
                ->groupBy('MF')
                ->get();


            return response()->json([
                'ongoingGender' => $ongoingGender,
                'ongoingGendercounter' => $ongoingGendercounter,
            ]);
        } else {
            // Debugbar::info($ongoingPROGRAMcounter);
            return response()->json([]);
        }
    }
}
