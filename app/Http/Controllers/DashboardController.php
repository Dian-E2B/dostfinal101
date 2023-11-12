<?php

namespace App\Http\Controllers;

use App\Models\Ongoing;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //
    public function dashboardview()
    {

        /*START SCHOOL GRAPH AREA*/
        // Fetch data from the "school" column
        $data = Ongoing::select('school')->get();

        $mostcommonschool = DB::table('ongoing')
            ->select('school')
            ->groupBy('school')
            ->orderByRaw('COUNT(*) DESC')
            ->first();

        // FIND THE MINIMUMS
        $minimumCount = DB::table('ongoing')
            ->select(DB::raw('COUNT(*) as min_count'))
            ->groupBy('school')
            ->orderBy('min_count', 'asc')
            ->value('min_count');

        // COUNT THE MINIMUMS
        $leastCommonSchools = DB::table('ongoing')
            ->select('school')
            ->groupBy('school')
            ->havingRaw(
                'COUNT(*) = ?',
                [$minimumCount]
            )
            ->get();


        // Preprocess the data: trim and replace blanks with "deferred", then make all uppercase
        $preprocessedData = $data->map(function ($item) {
            $schoolName = trim($item->school);

            // Replace blanks with "deferred"
            $schoolName = empty($schoolName) ? "Deffered" : strtoupper($schoolName);

            return $schoolName;
        });

        // Count the occurrences of each preprocessed school name (case-insensitive)
        $schoolCounts = $preprocessedData->countBy(function ($schoolName) {
            return trim($schoolName);
        });
        /*END SCHOOL GRAPH AREA*/

        /*START GENDER CHART AREA*/
        $genderData = Ongoing::select('MF', DB::raw('count(*) as count'))
            ->groupBy('MF')
            ->get();
        //gender highest
        $mosthighestgender = DB::table('ongoing')
            ->select('MF')
            ->groupBy('MF')
            ->orderByRaw('COUNT(*) DESC')
            ->first();

        //gender MINIMUMS
        $mostlowestgender = DB::table('ongoing')
            ->select('MF')
            ->groupBy('MF')
            ->orderByRaw('COUNT(*) ASC')
            ->first();
        /*END GENDER CHART AREA*/

        // Pass the aggregated data to the view
        return view('dashboard', compact('schoolCounts', 'genderData', 'leastCommonSchools', 'mostcommonschool', 'mosthighestgender', 'mostlowestgender'));
    }
}
