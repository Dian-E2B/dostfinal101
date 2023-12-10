<?php

namespace App\Http\Controllers;

use App\Models\Ongoing;
use App\Models\Cog;
use App\Models\Cogdetails;
use App\Models\Rsms_ra7687s;
use App\Models\Rsms_ra10612s;
use App\Models\Rsms_merits;
use App\Models\Rsms_noncompliance;
use App\Models\Sei;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use Barryvdh\Debugbar\Facades\Debugbar;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Cache;
use Termwind\Components\Dd;

class RsmsViewController extends Controller //OR ONGOING
{
    //
    public function rsmsview()
    {

        $startyears = Ongoing::distinct()->pluck('startyear')->filter()->values();
        $endyears = Ongoing::distinct()->pluck('endyear')->filter()->values();
        $semesters = Ongoing::distinct()->pluck('semester')->filter()->values();

        // dd($startyears, $endyears, $semesters);

        return view('rsms', compact('startyears', 'endyears', 'semesters'));
    }

    public function ongoinglistsview1(Request $request)
    {
        $startyear = $request->input('startyear');
        $endyear = $request->input('endyear');
        $semester = $request->input('semester');

        return view('ongoinglists');
    }

    public function getongoinglistgroupsajax(Request $request)
    {
        $results = DB::select("SELECT * FROM ongoing_monitoring ORDER BY startyear DESC;");
        return DataTables::of($results)->make(true);
    }

    //FILTERED OR IF VIEW IS CLICKED FROM ONGOING
    public function rsmsview2($startyear, $endyear, $semester)
    {
        session(['startyear' => $startyear, 'endyear' => $endyear, 'semester' => $semester]);
        return view('rsms2', compact('startyear', 'endyear', 'semester'));
    }


    //RETRIEVE DATA ON RSMS2 PAGE
    public function getongoinglistgroupsajaxviewclicked(Request $request)
    {
        // Retrieve values from the session
        $startyear = session('startyear');
        $endyear = session('endyear');
        $semester = session('semester');

        $results = DB::select("SELECT * FROM ongoing WHERE startyear = ? AND endyear = ? AND semester = ?", [$startyear, $endyear, $semester]);
        Debugbar::info($startyear, $endyear, $semester);

        return DataTables::of($results)->make(true);
    }


    public function getOngoingData(Request $request)
    {

        $currentYear = Carbon::now()->year - 1;

        $ongoing = Ongoing::select('*')->where('startyear', $currentYear)->get();

        return DataTables::of($ongoing)->make(true);
    }

    public function viewscholarrecordsview($number)
    {

        $results = Cog::select('startyear', DB::raw('COUNT(*) as row_count'))
            ->where('scholar_id', 1)
            ->groupBy('startyear')
            ->get();

        // Convert the Eloquent collection to an array
        $resultArrayyear = $results->pluck('startyear')->toArray();

        $resultArray = [];




        foreach ($resultArrayyear as $year) {
            // Fetching data for consecutive semesters with the same year
            for ($semester = 1; $semester <= 3; $semester++) {
                $cogdata = Cog::with('cogdetails')
                    ->where('scholar_id', $number)
                    ->where('semester', $semester)
                    ->where('startyear', $year)
                    ->get();
                //
                // Store the data for the semester in the result array
                $resultArray[$year][$semester] = $cogdata->toArray(); // Include all columns

            }
        }


        return view('viewscholarrecords', [
            'number' => $number,
            'resultArray' => $resultArray
        ]);
    }



    public function getscholargrades($number)
    {
        $cogdata = Cogdetails::find($number);
        Debugbar::info($number);

        if ($cogdata) {
            return response()->json($cogdata);
        }
    }



    public function getprospectusdata($number)
    {
        $prospectusdata = Cog::where('scholar_id', $number)->get();
        return DataTables::of($prospectusdata)->make(true);
    }

    public function viewscholarprospectus($number)
    {
        $prospectusdataview = Cog::where('id', $number)->get();
        // return view('viewscholarprospectus', compact('prospectusdataview'));
        return view('viewpropectus', ['prospectusdataview' => $prospectusdataview]);
    }

    public function officialrsms($number)
    {

        $seiresult = Sei::where('id', 1)->get();

        $results = Cog::select('startyear', DB::raw('COUNT(*) as row_count'))
            ->where('scholar_id', 1)
            ->groupBy('startyear')
            ->get();

        // Convert the Eloquent collection to an array
        $resultArrayyear = $results->pluck('startyear')->toArray();

        $resultArray = [];


        foreach ($resultArrayyear as $year) {
            // Fetching data for consecutive semesters with the same year
            for ($semester = 1; $semester <= 3; $semester++) {
                $cogdata = Cog::with('cogdetails')
                    ->where('scholar_id', $number)
                    ->where('semester', $semester)
                    ->where('startyear', $year)
                    ->get();
                //
                // Store the data for the semester in the result array
                $resultArray[$year][$semester] = $cogdata->toArray(); // Include all columns

            }
        }

        return view('officialrsms', [
            'number' => $number,
            'resultArray' => $resultArray,
            'seiresult' => $seiresult
        ]);
    }


    public function getscholarshipstatus($number)
    {
        $cogdata = Cog::find($number);
        // Debugbar::info($number);

        if ($cogdata) {
            return response()->json($cogdata);
        }
    }

    public function savescholarshipstatus(Request $request, $number)
    {

        // Find the record based on the given number
        $cogdata = Cog::where('id', $number)->first();
        Debugbar::info($cogdata);
        if (!$cogdata) {
            return response()->json(['error' => 'Record not found'], 404);
        }

        // Update the record with the new data
        $cogdata->update(['scholarshipstatus' => $request->input('scholarshipstatus')]);

        // You can return a response if needed
        return response()->json(['message' => 'Changes saved successfully']);
    }

    public function savecholargrades(Request $request, $number)
    {

        // Find the record based on the given number
        $cogdata = Cogdetails::where('id', $number)->first();

        if (!$cogdata) {
            return response()->json(['error' => 'Record not found'], 404);
        }

        // Update the record with the new data
        $cogdata->update($request->all());

        // You can return a response if needed
        return response()->json(['message' => 'Changes saved successfully']);
    }



    public function SaveChangesOngoing(Request $request, $number)
    {

        // Find the record based on the given number
        $record = Ongoing::where('NUMBER', $number)->first();

        if (!$record) {
            return response()->json(['error' => 'Record not found'], 404);
        }

        // Update the record with the new data
        $record->update($request->all());

        // You can return a response if needed
        return response()->json(['message' => 'Changes saved successfully']);
    }


    public function getOngoingDataFiltered(Request $request)
    {

        $startyear = session('startyear');
        $endyear = session('endyear');
        $semester = session('semester');

        $currentYear = Carbon::now()->year - 1;

        $ongoing = Ongoing::select('*')
            ->where('startyear', $startyear)
            ->where('endyear', $endyear)
            ->where('semester', $semester)
            ->get();

        return DataTables::of($ongoing)->make(true);
    }



    public function getOngoingById($number)
    {
        $ongoing = Ongoing::where('number', $number)->first();
        if (!$ongoing) {
            return response()->json(['error' => 'Record not found'], 404);
        }

        return response()->json($ongoing);
    }


    public function saveOngoingById($number)
    {
        $ongoing = Ongoing::where('number', $number)->first();
        if (!$ongoing) {
            return response()->json(['error' => 'Record not found'], 404);
        }

        return response()->json($ongoing);
    }






    public function rsmslistra7687view()
    {
        $rsmsra7687 = Rsms_ra7687s::all();
        return view('rsmslistra7687', compact('rsmsra7687'));
    }


    public function rsmslistra10612view()
    {
        $rsmsra10612 = Rsms_ra10612s::all();
        return view('rsmslistra10612', compact('rsmsra10612'));
    }

    public function rsmslistmeritview()
    {
        $rsmsmerit = Rsms_merits::all();
        return view('rsmslistmerit', compact('rsmsmerit'));
    }

    public function rsmslistnoncomplianceview()
    {
        $rsmsnoncompliance = Rsms_noncompliance::all();
        return view('rsmslistnoncompliance', compact('rsmsnoncompliance'));
    }
}
