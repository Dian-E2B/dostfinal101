<?php

namespace App\Http\Controllers;

use App\Models\Ongoing;
use App\Models\Replyslips;
use App\Models\Sei;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use function Laravel\Prompts\alert;

class AccessControlViewController extends Controller
{

    public function index()
    {
        try {
            $seisallstatus = DB::table('seis')
                ->join('scholar_statuses', 'seis.scholar_status_id', '=', 'scholar_statuses.id')
                ->select('seis.*', 'scholar_statuses.status_name')
                ->where('seis.scholar_status_id', '<>', 0)
                ->get();

            return view('accesscontrol', compact('seisallstatus'));
        } catch (\Exception $e) {

            // flash()->addError('Empty Records' . $e->getMessage());
            flash()->addError('Empty Records');
            return redirect()->back();
        }
    }


    public function accesscontrolpendingview()
    {
        try {


            $replyslipsandscholarjoinpending = DB::table('seis')
                ->join('scholar_statuses', 'seis.scholar_status_id', '=', 'scholar_statuses.id')
                ->select('seis.id', 'seis.year', 'seis.lname', 'seis.fname', 'seis.mname', 'seis.email', 'seis.gender_id',  'scholar_statuses.status_name')
                ->where('seis.scholar_status_id', '=', 1)
                ->get();

            // dd($$$$$);
            return view('accesscontrol', compact('replyslipsandscholarjoinpending'));
        } catch (\Exception $e) {
            flash()->addError('Empty Records');
            return redirect()->back();
        }
    }



    public function accesscontrolenrolledview()
    {

        try {
            $replyslipsjoinscholarenrolled =  DB::table('seis')
                ->join('scholar_statuses', 'seis.scholar_status_id', '=', 'scholar_statuses.id')
                ->select('seis.id', 'seis.year', 'seis.lname', 'seis.fname', 'seis.mname', 'seis.email', 'seis.gender_id',  'scholar_statuses.status_name')
                ->where('seis.scholar_status_id', '=', 3)
                ->get();
            return view('accesscontrol', compact('replyslipsjoinscholarenrolled'));
        } catch (\Exception $e) {
            flash()->addError('Empty Records');
            return redirect()->back();
        }
    }

    public function accesscontroldeferredview()
    {

        try {
            $replyslipsjoinscholardeferred = DB::table('seis')
                ->join('scholar_statuses', 'seis.scholar_status_id', '=', 'scholar_statuses.id')
                ->select('seis.id', 'seis.year', 'seis.lname', 'seis.fname', 'seis.mname', 'seis.email', 'seis.gender_id',  'scholar_statuses.status_name')
                ->where('seis.scholar_status_id', '=', 4)
                ->get();
            return view('accesscontrol', compact('replyslipsjoinscholardeferred'));
        } catch (\Exception $e) {
            flash()->addError('Empty Records');
            return redirect()->back();
        }
    }

    public function accesscontrolLOAview()
    {

        try {
            $replyslipsjoinscholarLOA = DB::table('seis')
                ->join('scholar_statuses', 'seis.scholar_status_id', '=', 'scholar_statuses.id')
                ->select('seis.id', 'seis.year', 'seis.lname', 'seis.fname', 'seis.mname', 'seis.email', 'seis.gender_id',  'scholar_statuses.status_name')
                ->where('seis.scholar_status_id', '=', 5)
                ->get();
            return view('accesscontrol', compact('replyslipsjoinscholarLOA'));
        } catch (\Exception $e) {
            flash()->addError('Empty Records');
            return redirect()->back();
        }
    }

    public function accesscontrolterminatedview()
    {

        try {
            $seisterminated = DB::table('seis')
                ->join('scholar_statuses', 'seis.scholar_status_id', '=', 'scholar_statuses.id')
                ->select('seis.id', 'seis.year', 'seis.lname', 'seis.fname', 'seis.mname', 'seis.email', 'seis.gender_id',  'scholar_statuses.status_name')
                ->where('seis.scholar_status_id', '=', 6)
                ->get();
            return view('accesscontrol', compact('seisterminated'));
        } catch (\Exception $e) {
            flash()->addError('Empty Records');
            return redirect()->back();
        }
    }

    public function enrollscholartoongoing(Request $request, $id)
    {
        $seisourcerecord = Sei::find($id);


        // Check if the record exists
        if ($seisourcerecord) {
            // Access the value of the 'year' column
            $yearValue = $seisourcerecord->year;
            $genderValue = $seisourcerecord->gender_id;

            if ($genderValue == 1) {
                $genderValue = "F";
            } else {
                $genderValue = "M";
            }

            $currentYear = now()->year;
            // Create a new record in the destination table
            $destinationRecord = new Ongoing();
            $destinationRecord->BATCH = $yearValue;
            $destinationRecord->NUMBER = $seisourcerecord->id; // Replace with actual column names
            $destinationRecord->NAME = $seisourcerecord->lname . ", " . $seisourcerecord->fname . " " . $seisourcerecord->mname;
            $destinationRecord->MF =  $genderValue;
            $destinationRecord->SCHOLARSHIPPROGRAM = null;
            $destinationRecord->SCHOOL = null;
            $destinationRecord->COURSE = null;
            $destinationRecord->GRADES = null;
            $destinationRecord->SummerREG = null;
            $destinationRecord->REGFORMS = null;
            $destinationRecord->REMARKS = null;
            $destinationRecord->STATUSENDORSEMENT = NULL;
            $destinationRecord->STATUSENDORSEMENT2 = NULL;
            $destinationRecord->STATUSENDORSEMENT2 = NULL;
            $destinationRecord->NOTATIONS = null;
            $destinationRecord->SUMMER = NULL;
            $destinationRecord->FARELEASEDTUITION = NULL;
            $destinationRecord->FARELEASEDTUITIONBOOKSTIPEND = NULL;
            $destinationRecord->LVDCAccount = NULL;
            $destinationRecord->HVCNotes = NULL;
            $destinationRecord->startyear =  $currentYear;
            $destinationRecord->endyear = $currentYear + 1;
            $destinationRecord->semester = 1;

            try {
                $destinationRecord->save();
                if ($destinationRecord) {
                    notyf()
                        ->position('x', 'center')
                        ->position('y', 'right')
                        ->duration(2000) // 2 seconds
                        ->addSuccess('Your application has been received.');
                    Replyslips::where('scholar_id', $id)->update(['replyslip_status_id' => 5]);
                    Sei::where('id', $id)->update(['scholar_status_id' => 3]);
                    return redirect()->route('accesscontrolenrolled');
                }
            } catch (\Exception $e) {
                // Check if it's a unique constraint violation
                if ($e->getCode() == 23000) {
                    Replyslips::where('scholar_id', $id)->update(['replyslip_status_id' => 5]);
                    Sei::where('id', $id)->update(['scholar_status_id' => 3]);
                    return redirect()->route('accesscontrolenrolled')->with('success', 'Your application has been received');
                } else {
                    // Handle other database-related exceptions
                }
            }
        }
    }
}
