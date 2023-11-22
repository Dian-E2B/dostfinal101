<?php

namespace App\Http\Controllers;

use App\Models\Ongoing;
use App\Models\Rsms_ra7687s;
use App\Models\Rsms_ra10612s;
use App\Models\Rsms_merits;
use App\Models\Rsms_noncompliance;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use Barryvdh\Debugbar\Facades\Debugbar;
use Auth;
use Carbon\Carbon;

class RsmsViewController extends Controller
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


    public function rsmsview2(Request $request)
    {

        $startyear = $request->input('startyear');
        $endyear = $request->input('endyear');
        $semester = $request->input('semester');


        session(['startyear' => $startyear, 'endyear' => $endyear, 'semester' => $semester]);

        $startyears = Ongoing::distinct()->pluck('startyear')->filter()->values();
        $endyears = Ongoing::distinct()->pluck('endyear')->filter()->values();
        $semesters = Ongoing::distinct()->pluck('semester')->filter()->values();

        // dd($startyears, $endyears, $semesters);

        return view('rsms2', compact('startyears', 'endyears', 'semesters'));

    }

    public function getOngoingData(Request $request)
    {

        $currentYear = Carbon::now()->year-1;

        $ongoing = Ongoing::select('*')->where('startyear', $currentYear)->get();

        return DataTables::of($ongoing)->make(true);


    }




    public function getOngoingDataFiltered(Request $request)
    {

    $startyear = session('startyear');
    $endyear = session('endyear');
    $semester = session('semester');

        $currentYear = Carbon::now()->year-1;

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
