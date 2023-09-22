<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Log;
use App\Imports\SeiImport;
use App\Models\Sei;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class SeiViewController extends Controller
{
    //
    public function seiqualifierview()
    {
        // $seis = Sei::with('scholars')->get();
        $seis = Sei::with('scholars')
            ->where('lacking', '')
            ->get();
        return view('seilist', compact('seis'));
    }

    public function create(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view(view: 'seilist');
    }


    public function store(Request $request)
    {

        try {

            Excel::import(new SeiImport(), $request->file(key: "excel_file"));
            return redirect()->back();
        } catch (\Exception $e) {
            // Handle the error
            // You can log the error, display a user-friendly message, or take other actions
            $errorMessage = $e->getMessage();
            // flash()->addError('There is a problem during upload ');
            echo 'An error occurred: ' . $errorMessage;
        }
    }

    public function seipotientalqualifierview()
    {
        $seis = Sei::with('scholars')
            ->where('lacking', '!=', '')
            ->get();
        return view('seilist2', compact('seis'));
    }
}
