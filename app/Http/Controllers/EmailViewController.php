<?php

namespace App\Http\Controllers;

use App\Models\EmailContent;
use App\Models\replyslips;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EmailViewController extends Controller
{
    //

    public function emailcontentview(){

        $content = EmailContent::first();
        return view('partials.emailcontent',compact('content'));

    }

    public function emaileditorview(){
        $emailContent = EmailContent::first();
        if (!$emailContent) {
            //abort(404); // Handle not found scenario
        }
        return view('/emaileditor',['emailContent' => $emailContent]);
    }

    public function emailstatusview()
    {
        $replyslips = replyslips::with('scholars')
            ->select('scholar_id', DB::raw('MAX(id) as max_id'))
            ->where('replyslip_status_id', 1)
            ->groupBy('scholar_id')
            ->get();
        return view('emails', compact('replyslips'));
    }
}
