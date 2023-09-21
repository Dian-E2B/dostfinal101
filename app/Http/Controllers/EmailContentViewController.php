<?php

namespace App\Http\Controllers;

use App\Models\EmailContent;
use Illuminate\Http\Request;

class EmailContentViewController extends Controller
{
    //
    public function index(){

        $content = EmailContent::first();
        return view('partials.emailcontent',compact('content'));

    }


}
