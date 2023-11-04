<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Log;
use App\Imports\SeiImport;
use App\Models\Gender;
use App\Models\Programs;
use App\Models\Scholar_status;
use App\Models\Scholars;
use App\Models\Sei;
use GrahamCampbell\ResultType\Success;
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

    public function edit(Request $request)
    {
        $email = $request->input('email');
        $scholarid = $request->input('SCHOLARID');

        $scholar = Scholars::where('id', $scholarid)->first();
        $sei = Sei::where('id', $scholarid)->first();
        $status = Scholar_status::all();
        $program = Programs::all();
        $gender = Gender::all();


        return view('seilist2editpage', compact('scholar', 'sei', 'status', 'program', 'gender'));
    }

    public function saveedit(Request $request)
    {
        // UNIQUEIDENTIFIER
        $sei_id = $request->input('sei_id');

        $sei = Sei::where('id', $sei_id)->first();
        $scholar = Scholars::where('id', $sei_id)->first();
        // dd($sei_id);

        try {
            $scholar->update([
                'fname' => $request->input('schol_fname'),
                'mname' => $request->input('schol_mname'),
                'lname' => $request->input('schol_lname'),
                'suffix' => $request->input('schol_suffix'),
                'email' => $request->input('schol_email'),
                'mobile' => $request->input('schol_mobile'),
                'bday' => $request->input('schol_bday'),
                'scholar_status_id' => $request->input('scholar_status_id'),
            ]);



            $sei->update([
                'strand' => $request->input('sei_strand'),
                'gender_id' => $request->input('sei_gender_id'),
                'program_id' => $request->input('sei_program_id'),
                'municipality' => $request->input('sei_municipality'),
                'province' => $request->input('sei_province'),
                'zipcode' => $request->input('sei_zipcode'),
                'barangay' => $request->input('sei_barangay'),
                'houseno' => $request->input('sei_houseno'),
                'street' => $request->input('sei_street'),
                'region' => $request->input('sei_region'),
                'hsname' => $request->input('sei_hsname'),
                'remarks' => $request->input('sei_remarks'),
                'lacking' => $request->input('sei_lacking'),
                'district' => $request->input('sei_district'),
            ]);

            $sei->save();
            $scholar->save();

            flash()->addSuccess('Your changes has been saved.');
            // return redirect('seilist2');
            // return $this->seipotientalqualifierview();
            return redirect()->route('seilist2');
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }
}
