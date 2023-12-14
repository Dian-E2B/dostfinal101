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
            //SCHOLARSHIPPROGRAM
            $ongoingPROGRAM = DB::table('ongoing')
                ->select('startyear', 'scholarshipprogram', DB::raw('COUNT(*) as scholarshipprogramcount'))
                ->whereNotNull('scholarshipprogram')
                ->groupBy('startyear', 'scholarshipprogram')
                ->get();

            $uniqueYears = $ongoingPROGRAM->pluck('startyear')->unique()->sort()->values();


            $ongoingPROGRAMcounter = DB::table('ongoing')
                ->select('scholarshipprogram')
                ->selectRaw('COUNT(*) as scholarshipprogramcount')
                ->whereIn('scholarshipprogram', ['MERIT', 'RA 10612', 'RA 7687'])
                ->groupBy('scholarshipprogram')
                ->get();

            // Calculate total count for all years
            $totalCount = $ongoingPROGRAMcounter->sum('scholarshipprogramcount');

            return view('dashboard', compact('ongoingPROGRAM', 'uniqueYears', 'totalCount', 'ongoingPROGRAMcounter'));
        } else {

            return view('dashboard', compact('schoolCounts', 'ongoingPROGRAM', 'ongoingCOURSE'));
        }
    }

    public function getprogramchartyearfilter(Request $request)
    {
        $startYear = $request->input('startyear');
        $endYear = $request->input('endyear');
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

            // Calculate total count for all years
            $totalCount = $ongoingPROGRAMcounter->sum('scholarshipprogramcount');

            $htmlContent = '';
            foreach ($ongoingPROGRAMcounter as $index => $result) {
                $htmlContent .= '<tr>';
                $htmlContent .= '<td>';

                // Add your conditions for scholarshipprogram
                if ($result->scholarshipprogram == 'MERIT') {
                    $htmlContent .= '<i class="fas fa-circle portionicon" style="color :blue" style:></i>' . $result->scholarshipprogram . ':';
                } elseif ($result->scholarshipprogram == 'RA 10612') {
                    $htmlContent .= '<i class="fas fa-circle portionicon" style="color :rgb(27, 27, 28)"></i>' . $result->scholarshipprogram . ':';
                } elseif ($result->scholarshipprogram == 'RA 7687') {
                    $htmlContent .= '<i class="fas fa-circle portionicon" style="color :rgb(40, 253, 243)"></i>' . $result->scholarshipprogram . ':';
                }

                $htmlContent .= '</td>';
                $htmlContent .= '<td style="">';

                // Calculate percentage and add to HTML content
                $percentage = ($result->scholarshipprogramcount / $totalCount) * 100;
                $htmlContent .= number_format($percentage, 2) . '%';

                $htmlContent .= '</td>';
                $htmlContent .= '</tr>';
            }


            return response()->json([
                'ongoingPROGRAM' => $ongoingPROGRAM,
                'uniqueYears' => $uniqueYears,
                'htmlContent' => $htmlContent
            ]);
        } else {

            return response()->json([]);
        }
    }
}
