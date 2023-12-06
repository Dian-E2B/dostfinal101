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
use App\Models\email_merit;
use App\Models\email_ra10612;
use App\Models\email_ra7687;
use App\Models\Sei;

class SendMailController extends Controller
{
    //


    public function index()
    {


        // CREATE VIEW email_ra7687 AS
        // SELECT email
        // FROM seis
        // WHERE program_id = 201
        // AND (email IS NOT NULL OR email != '')
        // AND (lacking IS NULL OR lacking = '')
        // GROUP BY email;



        // $emailsmerit = Sei::select('email')
        //     ->where('program_id', 101)
        //     ->where('scholar_status_id', '=', 0)
        //     ->whereNotNull('email')
        //     ->where(function ($query) {
        //         $query->whereNotNull('lacking')
        //             ->where('lacking', '!=', ''); // Add condition for 'lacking' not being an empty string
        //     })
        //     ->groupBy('email')
        //     ->pluck('email')
        //     ->toArray();


        // $emailsra10612 = Sei::select('email')
        //     ->where('program_id', 301)
        //     ->where('scholar_status_id', '=', 0)
        //     ->whereNotNull('email')
        //     ->where(function ($query) {
        //         $query->whereNotNull('lacking')
        //             ->where('lacking', '!=', ''); // Add condition for 'lacking' not being an empty string
        //     })
        //     ->groupBy('email')
        //     ->pluck('email')
        //     ->toArray();

        $emailsra7687 = email_ra7687::pluck('email')->toArray();
        $emailsmerit = email_merit::pluck('email')->toArray();
        $emailsra10612 = email_ra10612::pluck('email')->toArray();

        $content = EmailContent::first();


        foreach ($emailsra7687 as $email2) {
            $mailData = [
                'title' => '<h2><span contenteditable="false">Congratulations for qualifying for the 2022 DOST-SEI S&T Undergraduate Scholarships under <strong style="color: red">RA 7687</strong>.</span></h2> ',
                'message' => $content->content,
            ];

            $sei = Sei::where('email', $email2)->first();
            $id = $sei->id;
            $birthday = $sei->bday;
            $username = $sei->fname;
            $WithoutHyphensbirthday = str_replace('-', '', $birthday);
            $password101 = bcrypt($WithoutHyphensbirthday);

            try {
                // Send the email
                $var = Mail::to($email2)->send(new Mailnotifyawards($mailData));

                if ($var) {
                    // Update the scholar_status_id to 1 meaning pending
                    Sei::where('id', $id)->update(['scholar_status_id' => 1]);
                }



                //PUT ON PENDING ON EMAIL STATUS IF IT EXIST ALREADY, THEN NO NEED TO ADd IT
                Replyslips::firstOrCreate(
                    ['scholar_id' => $id],
                    ['replyslip_status_id' => 1] // 1 means pending
                );

                //ADD or UPDATE TO Student TABLE
                Student::updateOrCreate(
                    ['scholar_id' => $id],
                    ['email' => $email2, 'password' => $password101, 'username' => $username]
                );

                flash()->addSuccess('Your notice for All RA 7687 has been sent!');
            } catch (Exception $e) {
                dd($e->getMessage());
                //do nothing
            }
        }

        foreach ($emailsmerit as $email) {

            $mailData = [
                'title' => '<h2><span contenteditable="false">Congratulations for qualifying for the 2022 DOST-SEI S&T Undergraduate Scholarships under <strong style="color: red">MERIT</strong>.</span></h2> ',
                'message' => $content->content,
            ];

            $sei = Sei::where('email', $email)->first();
            $id = $sei->id;
            $birthday = $sei->bday;
            $username = $sei->fname;
            $WithoutHyphensbirthday = str_replace('-', '', $birthday);
            $password101 = bcrypt($WithoutHyphensbirthday);

            try {
                // Send the email
                Mail::to($email)->send(new Mailnotifyawards($mailData));

                // Update the scholar_status_id to 1 meaning pending
                Sei::where('id', $id)->update(['scholar_status_id' => 1]);

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

                flash()->addSuccess('Your notice for All Merit has been sent!');
            } catch (Exception $e) {
                dd($e->getMessage());
                //do nothing
            }
        }


        foreach ($emailsra10612 as $email) {

            $mailData = [
                'title' => '<h2><span contenteditable="false">Congratulations for qualifying for the 2022 DOST-SEI S&T Undergraduate Scholarships under <strong style="color: red">RA 10612</strong>.</span></h2> ',
                'message' => $content->content,
            ];

            $sei = Sei::where('email', $email)->first();
            $id = $sei->id;
            $birthday = $sei->bday;
            $username = $sei->fname;
            $WithoutHyphensbirthday = str_replace('-', '', $birthday);
            $password101 = bcrypt($WithoutHyphensbirthday);

            try {
                // Send the email
                Mail::to($email)->send(new Mailnotifyawards($mailData));

                // Update the scholar_status_id to 1 meaning pending
                Sei::where('id', $id)->update(['scholar_status_id' => 1]);

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

                flash()->addSuccess('Your notice for RA 10612 has been sent!');
            } catch (Exception $e) {
                dd($e->getMessage());
                //do nothing
            }
        }


        return back();
    }
}
