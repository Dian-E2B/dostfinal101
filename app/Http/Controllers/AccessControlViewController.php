<?php

namespace App\Http\Controllers;

use App\Models\replyslips;
use Illuminate\Http\Request;

class AccessControlViewController extends Controller
{
    //
    public function index(){

        $replyslipsjoinscholar = replyslips::join('scholars', 'replyslips.scholar_id', '=', 'scholars.id')
            ->select('replyslips.*', 'scholars.*')
            ->get();

return view('accesscontrol', compact('replyslipsjoinscholar'));
    }
}
