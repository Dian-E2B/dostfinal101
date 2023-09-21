<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Municipalities;
use App\Models\Sei;
use App\Imports\SeiImport;
use App\Models\Scholars;
use App\Http\Controllers\Log;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;

use function Laravel\Prompts\alert;

class SeiQualifierviewController extends Controller
{
    //
    public function index()
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
}
