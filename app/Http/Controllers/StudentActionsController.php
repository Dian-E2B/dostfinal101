<?php

namespace App\Http\Controllers;


use App\Models\Cog;
use App\Models\Cogdetails;
use App\Models\Cogsdraft;
use App\Models\Replyslips;
use App\Models\Scholars;
use App\Models\Sei;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Carbon\Carbon;

class StudentActionsController extends Controller
{
    //
    public function replyslipsave(Request $request)
    {
        // Store the uploaded image in the "public/signatures" directory
        $scholarid = $request->input('scholarid');
        $reason1 = $request->input('reason');
        $fname = Sei::where('id', $scholarid)->value('fname');
        $lname = Sei::where('id', $scholarid)->value('lname');

        $checkreplyslipstatus = Replyslips::where('scholar_id', $scholarid)->value('replyslip_status_id');
        $customstudentsignaturefilename = $scholarid . 'signatures' . time() . '.' . $request->file('signaturestudent')->getClientOriginalExtension();
        $customparentsignaturefilename = $scholarid . 'signatureparent' . time() . '.' . $request->file('signatureparent')->getClientOriginalExtension();
        if ($checkreplyslipstatus == 1) {
            $request->file('signaturestudent')->storeAs('public/signatures', $customstudentsignaturefilename);
            $request->file('signatureparent')->storeAs('public/signatures', $customparentsignaturefilename);
        }

        if ($request->has('acceptcheckbox')) {

            // echo 'acceptcheckbox is checked';
            Replyslips::where('scholar_id', $scholarid)->update([
                'signature' => 'storage/signatures/' . $customstudentsignaturefilename,
                'reason' => $reason1,
                'signatureparents' => 'storage/signatures/' . $customparentsignaturefilename,
                'updated_at' => now(),
                'replyslip_status_id' => 2
            ]);

            return redirect('/student/dashboard');
        } else if ($request->has('defferedcheckbox')) {

            Replyslips::where('scholar_id', $scholarid)->update([
                'signature' => 'storage/signatures/' . $customstudentsignaturefilename,
                'signatureparents' => 'storage/signatures/' . $customparentsignaturefilename,
                'reason' => $reason1,
                'updated_at' => now(),
                'replyslip_status_id' => 4
            ]);
            return redirect('/student/dashboard');
        } else if ($request->has('rejectcheckbox')) {

            Replyslips::where('scholar_id', $scholarid)->update([
                'signature' => 'storage/signatures/' . $customstudentsignaturefilename,
                'signatureparents' => 'storage/signatures/' . $customparentsignaturefilename,
                'reason' => $reason1,
                'updated_at' => now(),
                'replyslip_status_id' => 3
            ]);
            return redirect('/student/dashboard');
        }

        return redirect('/student/dashboard');
    }




    //GRADES SAVE
    public function cogsave(Request $request)
    {

        if ($request->is_draft == 1) {
            $data = $request->validate([
                'subjectnames.*.name' => 'required',
                'grades.*.grade' => 'required',
                'units.*.unit' => 'required',
            ]);

            /* dd($data);*/
            $scholarid = $request->input('scholarid');
            $semesterinput = $request->input('semester');
            $startyearinput = $request->input('startyear');
            $endyearinput = $request->input('endyear');
            // $schoolyearinput = $request->input('schoolyear');

            $customstudentprospectusfilename = $scholarid . 'prospectus' . time() . '.' . $request->file('imagegrade')->getClientOriginalExtension();
            $request->file('imagegrade')->storeAs('public/prospectus', $customstudentprospectusfilename);
            //         dd($customstudentprospectusfilename);

            $cog = Cog::create([
                'scholar_id' => $scholarid,
                'semester' => $semesterinput,
                'failnum' => 0,
                'cog_status' => 0,
                'startyear' => $startyearinput,
                'endyear' => $endyearinput,
                'date_uploaded' => now(),
                'prospectus_details' => 'storage/prospectus/' . $customstudentprospectusfilename,
                'draft' => 1,
            ]);




            foreach ($data['subjectnames'] as $index => $subject) {
                $cog->cogdetails()->create([
                    'subjectname' => $subject['name'],
                    'grade' => $data['grades'][$index]['grade'],
                    'unit' => $data['units'][$index]['unit'],
                ]);
            }

            notyf()
                ->position('x', 'center')
                ->position('y', 'top')
                ->duration(2000) // 2 seconds
                ->addSuccess('Grades has been Saved as Draft');
        } else {
            // Publish the record
            // Create a new record
            $data = $request->validate([
                'subjectnames.*.name' => 'required',
                'grades.*.grade' => 'required',
                'units.*.unit' => 'required',
            ]);

            /* dd($data);*/
            $scholarid = $request->input('scholarid');
            $semesterinput = $request->input('semester');
            $startyearinput = $request->input('startyear');
            $endyearinput = $request->input('endyear');
            // $schoolyearinput = $request->input('schoolyear');

            $customstudentprospectusfilename = $scholarid . 'prospectus' . time() . '.' . $request->file('imagegrade')->getClientOriginalExtension();
            $request->file('imagegrade')->storeAs('public/prospectus', $customstudentprospectusfilename);
            //         dd($customstudentprospectusfilename);

            $cog = Cog::create([
                'scholar_id' => $scholarid,
                'semester' => $semesterinput,
                'failnum' => 0,
                'cog_status' => 0,
                'startyear' => $startyearinput,
                'endyear' => $endyearinput,
                'date_uploaded' => now(),
                'prospectus_details' => 'storage/prospectus/' . $customstudentprospectusfilename,
                'draft' => 0,
            ]);

            if ($semesterinput  == 3) {
            } else {
                foreach ($data['subjectnames'] as $index => $subject) {
                    $cog->cogdetails()->create([
                        'subjectname' => $subject['name'],
                        'grade' => $data['grades'][$index]['grade'],
                        'unit' => $data['units'][$index]['unit'],
                    ]);
                }
            }
            notyf()
                ->position('x', 'center')
                ->position('y', 'top')
                ->duration(2000) // 2 seconds
                ->addSuccess('Grades has been Saved');
        }

        return back();
    }

    public function saveDraft(Request $request)
    {


        if ($request->is_delete == 1) {
            $cog_id = $request->input('cog_id');
            $cog = Cog::find($cog_id);

            $cog->update([
                'draft' => 2,
            ]);

            return redirect()->back()->with('success', 'Draft DELETED successfully');
        } else {
            $scholarid = $request->input('scholar_id');
            /*   $customstudentprospectusfilename = $scholarid . 'prospectus' . time() . '.' . $request->file('prospectus1')->getClientOriginalExtension();
            $request->file('prospectus1')->storeAs('public/prospectus', $customstudentprospectusfilename);
 */
            $cog_id = $request->input('cog_id');
            $cog = Cog::find($cog_id);
            if ($cog) {
                // Update the draft column to 0
                $cog->update([
                    'draft' => 0,
                    /*  'prospectus_details' => 'storage/prospectus/' . $customstudentprospectusfilename, */
                ]);
            }
            return redirect()->back()->with('success', 'Draft submitted successfully');
        }

        // Redirect or return a response

    }
}
