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
use App\Models\Sei;

class SendMailController extends Controller
{
    //


    public function index()
    {


        $emailsra7687 = Sei::select('email')
            ->where('program_id', 201)
            ->where('scholar_status_id', '!=', 0)
            ->whereNotNull('email') // Check for a non-null email
            ->groupBy('email')
            ->pluck('email') // Pluck the email addresses
            ->toArray(); // Convert the result to an array


        $emailsmerit = Sei::select('email')
            ->select('email')
            ->where('program_id', 101)
            ->where('scholar_status_id', '!=', 0)
            ->whereNotNull('email') // Check for a non-null email
            ->groupBy('email')
            ->pluck('email') // Pluck the email addresses
            ->toArray(); // Convert the result to an array


        $emailsra10612 = Sei::select('email')
            ->select('email')
            ->where('program_id', 301)
            ->where('scholar_status_id', '!=', 0)
            ->whereNotNull('email') // Check for a non-null email
            ->groupBy('email')
            ->pluck('email') // Pluck the email addresses
            ->toArray(); // Convert the result to an array



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
