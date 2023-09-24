<?php

namespace App\Http\Controllers;

use App\Models\Programs;
use App\Models\replyslips;
use App\Models\Scholars;
use App\Models\Sei;
use App\Models\Student;
use Illuminate\Http\Request;

class StudentViewController extends Controller
{
    //
    public function index(){
        $userId = auth()->id();
        $studentuser = Student::where('id', $userId)->first();
        $scholarId = $studentuser->scholar_id;
        $replyslips = Replyslips::where('scholar_id', $scholarId)->get();
        $replyslipstatus = Replyslips::where('scholar_id', $scholarId)->value('replyslip_status_id');
        return view('student.dashboard', compact('scholarId','replyslips','replyslipstatus')); //DASHBOARD VIEW
    }

    public function replyslipview()
    {

        $userId = auth()->id();
        $studentuser = Student::where('id', $userId)->first();

        if ($studentuser) {
            // Retrieve all reply slip records with the matching scholar_id
            $scholarId = $studentuser->scholar_id;
            $spasno = Scholars::where('id', $scholarId)->value('spasno');
            $programid = Sei::where('spasno', $spasno)->value('program_id');
            $programname = Programs::where('id', $programid)->value('progname');
           // $programstudent = $scholar->program;

           // dd($scholarId,$programname);
            $replyslips = Replyslips::where('scholar_id', $scholarId)->get(); // Filter by scholar_id

            $replyslipstatusid = Replyslips::where('scholar_id', $scholarId)->value('replyslip_status_id'); // Filter by scholar_id
            $replyslipsignature = Replyslips::where('scholar_id', $scholarId)->value('signature');
            $replyslipparentsignature = Replyslips::where('scholar_id', $scholarId)->value('signatureparents');
//echo $replyslipstatusid;

                return view('student.replyslipview',
                    compact('studentuser', 'replyslips','programname','replyslipstatusid','replyslipsignature','replyslipparentsignature'));

        } else {
            // Handle the case where the authenticated user's ID doesn't have a matching scholar_id
            return view('student.replyslipview');
        }

}
}
