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
        $replyslipsandscholarjoinpending = replyslips::join('scholars', 'replyslips.scholar_id', '=', 'scholars.id')
            ->select('replyslips.*', 'scholars.*')
            ->where('replyslips.replyslip_status_id',1)
            ->get();

        $replyslipsandscholarjoinaccepted = replyslips::join('scholars', 'replyslips.scholar_id', '=', 'scholars.id')
            ->select('replyslips.*', 'scholars.*')
            ->where('replyslips.replyslip_status_id',2)
            ->get();

        return view('emails', compact('replyslipsandscholarjoinpending','replyslipsandscholarjoinaccepted'));
    }
}
