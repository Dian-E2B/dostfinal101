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
            /* $replyslipsjoinscholar = Replyslips::join('scholars', 'replyslips.scholar_id', '=', 'scholars.id')
                ->join('scholar_status', 'scholars.scholar_status_id', '=', 'scholar_status.id')
                ->select('replyslips.*', 'scholars.*', 'scholar_status.*')
                ->get(); */

            $seisallstatus = DB::table('seis')
                ->join('scholar_statuses', 'seis.scholar_status_id', '=', 'scholar_statuses.id')
                ->select('seis.*', 'scholar_statuses.status_name')
                ->get();

            return view('accesscontrol', compact('seisallstatus'));
        } catch (\Exception $e) {

            // flash()->addError('Empty Records' . $e->getMessage());
            flash()->addError('    Empty Records');
            return redirect()->back();
        }
    }


    public function accesscontrolpendingview()
    {
        try {


            $replyslipsandscholarjoinpending = Sei::join('replyslips', 'seis.id', '=', 'replyslips.scholar_id')
                ->select('seis.id as sei_id', 'replyslips.id as replyslip_id', 'replyslips.*', 'seis.*')
                ->where('replyslips.replyslip_status_id', 2)
                ->get();

            // dd($$$$$);
            return view('accesscontrol', compact('replyslipsandscholarjoinpending'));
        } catch (\Exception $e) {
            flash()->addError('Empty Records');
            return redirect()->back();
        }
    }

    public function accesscontrolongoingview()
    {

        $replyslipsjoinscholarongoing = Replyslips::join('scholars', 'replyslips.scholar_id', '=', 'scholars.id')
            ->join('scholar_status', 'scholars.scholar_status_id', '=', 'scholar_status.id')
            ->select('replyslips.*', 'scholars.*', 'scholar_status.*')
            ->where('scholar_status_id', '=', 2) // Add your where condition here
            ->get();


        return view('accesscontrol', compact('replyslipsjoinscholarongoing'));
    }

    public function accesscontrolenrolledview()
    {

        try {
            $replyslipsjoinscholarenrolled =  Sei::join('replyslips', 'seis.id', '=', 'replyslips.scholar_id')
                ->select('seis.id as sei_id', 'replyslips.id as replyslip_id', 'replyslips.*', 'seis.*')
                ->where('seis.scholar_status_id', 3)
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
            $replyslipsjoinscholardeferred = Replyslips::join('scholars', 'replyslips.scholar_id', '=', 'scholars.id')
                ->join('scholar_status', 'scholars.scholar_status_id', '=', 'scholar_status.id')
                ->select('replyslips.*', 'scholars.*', 'scholar_status.*')
                ->where('scholar_status_id', '=', 4) // Add your where condition here
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
            $replyslipsjoinscholarLOA = Replyslips::join('scholars', 'replyslips.scholar_id', '=', 'scholars.id')
                ->join('scholar_status', 'scholars.scholar_status_id', '=', 'scholar_status.id')
                ->select('replyslips.*', 'scholars.*', 'scholar_status.*')
                ->where('scholar_status_id', '=', 5) // Add your where condition here
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
            /* $replyslipsjoinscholarterminated = Replyslips::join('sei', 'replyslips.scholar_id', '=', 'sei.id')
                ->join('scholar_status', 'scholars.scholar_status_id', '=', 'scholar_status.id')
                ->select('replyslips.*', 'scholars.*', 'scholar_status.*')
                ->where('scholar_status_id', '=', 6) // Add your where condition here
                ->get(); */
            $seisterminated = DB::table('seis')
                ->join('scholar_statuses', 'seis.scholar_status_id', '=', 'scholar_statuses.id')
                ->select('seis.*', 'scholar_statuses.status_name')
                ->where('seis.scholar_status_id', 6)
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
                    notyf()->addSuccess('Your application has been received.');

                    Replyslips::where('scholar_id', $id)->update(['replyslip_status_id' => 5]);
                    Sei::where('id', $id)->update(['scholar_status_id' => 3]);
                    return redirect()->route('accesscontrolenrolled')->with('success', 'Your application has been received');
                }
            } catch (\Exception $e) {
                // Check if it's a unique constraint violation
                if ($e->getCode() == 23000) {
                    $notif =  notyf()->addSuccess('Your application has been received.');

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
