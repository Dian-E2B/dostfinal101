<?php

namespace App\Http\Controllers;

use App\Models\EmailContent;
use App\Models\Replyslips;
use App\Models\Student;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\DB; // For the DB facade
use App\Models\Scholars;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\Mailnotifyawards;

class SendMailController extends Controller
{
    //


    public function index()
    {


        $emailsmerit = Scholars::join('seis', 'seis.spasno', '=', 'scholars.spasno')
            ->select('scholars.email')
            ->where('seis.program_id', 201)
            ->where('scholars.scholar_status_id', '!=', 0)
            ->distinct()
            ->pluck('email')
            ->toArray();

       $emailsra7687 = Scholars::join('seis', 'scholars.spasno', '=', 'scholars.spasno')
           ->select('scholars.email')
           ->where('seis.program_id', 102)
           ->where('scholars.scholar_status_id', '!=', 0) // Add your where condition here
           ->distinct()
           ->pluck('scholars.email')
           ->toArray();
       ; // You can adjust the query as needed

        // Pass the content to a view and display it

//        $emails = Scholars::select('email')
//            ->distinct()
//            ->pluck('email')
//            ->toArray();
        $content = EmailContent::first();



        foreach ($emailsra7687 as $email2) {
            $mailData = [
                'title'=>'<h2><span contenteditable="false">Congratulations for qualifying for the 2022 DOST-SEI S&T Undergraduate Scholarships under <strong style="color: red">RA 7687</strong>.</span></h2> ',
                'message' => $content->content,
            ];

            $scholarid = Scholars::where('email', $email2)->first();
            $id = $scholarid->id;
            $birthday = $scholarid->bday;
            $username = $scholarid->fname;
            $WithoutHyphensbirthday = str_replace('-', '', $birthday);
            $password101 = bcrypt($WithoutHyphensbirthday);

                    try {
                        // Send the email
                        Mail::to($email2)->send(new Mailnotifyawards($mailData));

                        //PUT ON PENDING ON EMAIL STATUS IF IT EXIST ALREADY, THEN NO NEED TO AD IT
                        Replyslips::firstOrCreate(
                            ['scholar_id' => $id],
                            ['replyslip_status_id' => 1] // 1 means pending
                        );

                        //ADD or UPDATE TO Student TABLE
                        Student::updateOrCreate(
                            ['scholar_id' => $id],
                            ['email' => $email2, 'password' => $password101, 'username' => $username]
                        );


                    } catch (Exception $e) {
                        dd($e->getMessage());
                         //do nothing
                    }

            }

        foreach ($emailsmerit as $email) {

            $mailData = [
                'title'=>'<h2><span contenteditable="false">Congratulations for qualifying for the 2022 DOST-SEI S&T Undergraduate Scholarships under <strong style="color: red">MERIT</strong>.</span></h2> ',
                'message' => $content->content,
            ];

            $scholarid = Scholars::where('email', $email)->first();
            $id = $scholarid->id;
            $birthday = $scholarid->bday;
            $username = $scholarid->fname;
            $WithoutHyphensbirthday = str_replace('-', '', $birthday);
            $password101 = bcrypt($WithoutHyphensbirthday);

            try {
                // Send the email
                Mail::to($email)->send(new Mailnotifyawards($mailData));

                //PUT ON PENDING ON EMAIL STATUS IF IT EXIST ALREADY, THEN NO NEED TO AD IT
                Replyslips::firstOrCreate(
                    ['scholar_id' => $id],
                    ['replyslip_status_id' => 1] // 1 means pending
                );

                //ADD or UPDATE TO Student TABLE
                Student::updateOrCreate(
                    ['scholar_id' => $id],
                    ['email' => $email, 'password' => $password101, 'username' => $username]
                );


            } catch (Exception $e) {
                dd($e->getMessage());
                //do nothing
            }

        }

        flash()->addSuccess('Your notice has been sent!');
        return back();


    }
}
