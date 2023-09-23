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
        $replyslips = replyslips::all();
        return view('emails', compact('replyslips'));
    }
}
