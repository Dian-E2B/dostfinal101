<?php

namespace App\Http\Controllers;

use App\Models\Rsms;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //
    public function dashboardview()
    {
        // Fetch data from the "school" column
        $data = Rsms::select('school')->get();

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


        $genderData = Rsms::select('MF', DB::raw('count(*) as count'))
            ->groupBy('MF')
            ->get();

        // Pass the aggregated data to the view
        return view('dashboard', compact('schoolCounts', 'genderData'));
    }
}
