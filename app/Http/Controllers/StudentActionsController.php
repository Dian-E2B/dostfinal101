<?php

namespace App\Http\Controllers;


use App\Models\Cogdetails;
use App\Models\replyslips;
use App\Models\Scholars;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;

class StudentActionsController extends Controller
{
    //
    public function replyslipsave(Request $request){
        // Store the uploaded image in the "public/signatures" directory
        $scholarid = $request->input('scholarid');
        $reason1 = $request->input('reason');
        $fname = Scholars::where('id', $scholarid)->value('fname');
        $lname = Scholars::where('id', $scholarid)->value('lname');

        $checkreplyslipstatus = replyslips::where('scholar_id', $scholarid)->value('replyslip_status_id');
        $customstudentsignaturefilename = $scholarid . $fname . $lname . 'signatures' . time() . '.' . $request->file('signaturestudent')->getClientOriginalExtension();
        $customparentsignaturefilename = $scholarid . $fname . $lname . 'signatureparent' . time() . '.' . $request->file('signatureparent')->getClientOriginalExtension();
        if ($checkreplyslipstatus==1){
            $request->file('signaturestudent')->storeAs('public/signatures', $customstudentsignaturefilename);
            $request->file('signatureparent')->storeAs('public/signatures', $customparentsignaturefilename);
        }

        if ($request->has('acceptcheckbox')) {

           // echo 'acceptcheckbox is checked';
            Replyslips::where('scholar_id', $scholarid)->update([
                'signature' => 'storage/signatures/'.$customstudentsignaturefilename,
                'reason' => $reason1,
                'signatureparents' => 'storage/signatures/'.$customparentsignaturefilename,
                'updated_at' => now(),
                'replyslip_status_id' => 2
            ]);

            return redirect('/student/dashboard');
        } else if($request->has('defferedcheckbox')) {

            Replyslips::where('scholar_id', $scholarid)->update([
                'signature' => 'storage/signatures/'.$customstudentsignaturefilename,
                'signatureparents' => 'storage/signatures/'.$customparentsignaturefilename,
                'reason' => $reason1,
                'updated_at' => now(),
                'replyslip_status_id' => 4
            ]);
            return redirect('/student/dashboard');
        }
        else if($request->has('rejectcheckbox')) {

            Replyslips::where('scholar_id', $scholarid)->update([
                'signature' => 'storage/signatures/'.$customstudentsignaturefilename,
                'signatureparents' => 'storage/signatures/'.$customparentsignaturefilename,
                'reason' => $reason1,
                'updated_at' => now(),
                'replyslip_status_id' => 3
            ]);
            return redirect('/student/dashboard');
        }

        return redirect('/student/dashboard');
    }

    public function cogsave(Request $request) {
        $data = $request->all();

        foreach ($data['subjectgradeData'] as $product) {
            $name = $product['name'];
            $price = $product['grade'];
            Cogdetails::create([
                'subjectname' => $name,
                'grade' => $price,
            ]);
        }





        return response()->json(['message' => 'Products inserted successfully'], 201);
    }
}
