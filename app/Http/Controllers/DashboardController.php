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

            $data = Ongoing::select('school')->get();
            $preprocessedData = $data->map(function ($item) {  // Preprocess the data: trim and replace blanks with "deferred", then make all uppercase
                $schoolName = trim($item->school);

                $schoolName = empty($schoolName) ? "Deffered" : strtoupper($schoolName);  // Replace blanks with "deferred"
                return $schoolName;
            });

            //SCHOOL CHART
            $schoolCounts = $preprocessedData->countBy(function ($schoolName) {
                return trim($schoolName); // Count the occurrences of each preprocessed school name (case-insensitive)
            });

            //DAVAOCITY ra 7687
            $ongoingQualifiers = DB::table('ongoing')
                ->select('startyear', DB::raw('COUNT(*) as QualifierCount'))
                ->groupBy('startyear')
                ->get();

            //SCHOLARSHIPPROGRAM
            $ongoingPROGRAM = DB::table('ongoing')
                ->select('scholarshipprogram', DB::raw('COUNT(*) as scholarshipprogramcount'))
                ->whereNotNull('scholarshipprogram')
                ->groupBy('scholarshipprogram')
                ->get();

            //COURSE
            $ongoingCOURSE = DB::table('ongoing')
                ->select('course', DB::raw('COUNT(*) as coursecount'))
                ->whereNotNull('course')
                ->groupBy('course')
                ->get();


            return view('dashboard', compact('schoolCounts', 'ongoingPROGRAM', 'ongoingCOURSE'));
        } else {

            //SCHOOL CHART
            $data = Ongoing::select('school')
                ->where('startYear', $startYear)
                ->where('endYear', $endYear)
                ->get();


            $preprocessedData = $data->map(function ($item) {  // Preprocess the data: trim and replace blanks with "deferred", then make all uppercase
                $schoolName = trim($item->school);

                $schoolName = empty($schoolName) ? "Deffered" : strtoupper($schoolName);  // Replace blanks with "deferred"
                return $schoolName;
            });

            $schoolCounts = $preprocessedData->countBy(function ($schoolName) {
                return trim($schoolName); // Count the occurrences of each preprocessed school name (case-insensitive)
            });


            //SCHOLARSHIPPROGRAM
            $ongoingPROGRAM = DB::table('ongoing')
                ->select('scholarshipprogram', DB::raw('COUNT(*) as scholarshipprogramcount'))
                ->where('startyear', '>=', $startYear)
                ->where('endyear', '<=', $endYear)
                ->groupBy('scholarshipprogram')
                ->get();

            //COURSE
            $ongoingCOURSE = DB::table('ongoing')
                ->select('course', DB::raw('COUNT(*) as coursecount'))
                ->where('startyear', '>=', $startYear)
                ->where('endyear', '<=', $endYear)
                ->whereNotNull('course')
                ->groupBy('course')
                ->get();

            return view('dashboard', compact('schoolCounts', 'ongoingPROGRAM', 'ongoingCOURSE'));
        }




        // Debugbar::info($ongoingRecords);
    }
}
