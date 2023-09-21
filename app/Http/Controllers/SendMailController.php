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

        $emails = Scholars::where('scholar_status_id', '!=', 0) // Add a where condition
        ->select('email')
            ->distinct()
            ->pluck('email')
            ->toArray();

       ; // You can adjust the query as needed

        // Pass the content to a view and display it

//        $emails = Scholars::select('email')
//            ->distinct()
//            ->pluck('email')
//            ->toArray();
        $content = EmailContent::first();

        $mailData = [
                'title'=>' ',
                'message' => $content->content,
        ];

        foreach ($emails as $email) {
            $scholarid = Scholars::where('email', $email)->first();
            $id = $scholarid->id;
            $birthday = $scholarid->bday;
            $WithoutHyphensbirthday = str_replace('-', '', $birthday);


//            if ($birthday) {
//
//                dd("Scholar's Birthday: " . $birthday,$WithoutHyphensbirthday) ;
//            } else {
//                dd ("Scholar with email $email not found.");
//            }
               // dd($id);
                    try {
                        // Send the email
                        Mail::to($email)->send(new Mailnotifyawards($mailData));

                        // Log the successful notification

                        Replyslips::firstOrCreate(
                            ['scholar_id' => $id],
                            ['replyslip_status_id' => 1] // 1 means pending
                        );

                        Replyslips::create([
                            'scholar_id' => $id,
                            'replyslip_status_id' => 1,// 1 means pending
                        ]);
                        //ADD or UPDATE TO Student TABLE
                        Student::updateOrCreate(
                            ['email' => $email],
                            ['password' => $WithoutHyphensbirthday]
                        );

                    } catch (Exception $e) {
                        dd($e->getMessage());

                        // Log the failed notification
//                        Replyslips::create([
//                            'scholar_id' => $id,
//                            'replyslip_status_id' => null, //as not yet notified
//                        ]);

                    }

            }

      //  Mail::to($emails)->send(new Mailnotifyawards($mailData));
      // dd('ok');
        flash()->addSuccess('Your notice has been sent!');
        return back();


    }
}
