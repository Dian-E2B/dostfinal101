<?php

namespace App\Http\Controllers;

use App\Models\EmailContent;
use Illuminate\Http\Request;

class EmailEditorViewController extends Controller
{
    //
    public function index(){
        $emailContent = EmailContent::first();
    if (!$emailContent) {
       //abort(404); // Handle not found scenario
    }
        return view('/emaileditor',['emailContent' => $emailContent]);



}



}
