<?php

namespace App\Http\Controllers;

use App\Models\replyslips;
use Illuminate\Http\Request;

class AccessControlViewController extends Controller
{
    //
    public function index(){

//        $replyslipsjoinscholar = replyslips::join('scholars', 'replyslips.scholar_id', '=', 'scholars.id')
//            ->select('replyslips.*', 'scholars.*')
//            ->get();
        $replyslipsjoinscholar = replyslips::join('scholars', 'replyslips.scholar_id', '=', 'scholars.id')
            ->join('scholar_status', 'scholars.scholar_status_id', '=', 'scholar_status.id')
            ->select('replyslips.*', 'scholars.*', 'scholar_status.*')
            ->get();

return view('accesscontrol', compact('replyslipsjoinscholar'));
    }



    public function accesscontrolpendingview(){

        $replyslipsjoinscholarpending = replyslips::join('scholars', 'replyslips.scholar_id', '=', 'scholars.id')
            ->join('scholar_status', 'scholars.scholar_status_id', '=', 'scholar_status.id')
            ->select('replyslips.*', 'scholars.*', 'scholar_status.*')
            ->where('scholar_status_id', '=', 1) // Add your where condition here
            ->get();


        return view('accesscontrol', compact('replyslipsjoinscholarpending'));
    }
    public function accesscontrolongoingview(){

        $replyslipsjoinscholarongoing = replyslips::join('scholars', 'replyslips.scholar_id', '=', 'scholars.id')
            ->join('scholar_status', 'scholars.scholar_status_id', '=', 'scholar_status.id')
            ->select('replyslips.*', 'scholars.*', 'scholar_status.*')
            ->where('scholar_status_id', '=', 2) // Add your where condition here
            ->get();


        return view('accesscontrol', compact('replyslipsjoinscholarongoing'));
    }

    public function accesscontrolenrolledview(){

        $replyslipsjoinscholarenrolled = replyslips::join('scholars', 'replyslips.scholar_id', '=', 'scholars.id')
            ->join('scholar_status', 'scholars.scholar_status_id', '=', 'scholar_status.id')
            ->select('replyslips.*', 'scholars.*', 'scholar_status.*')
            ->where('scholar_status_id', '=', 2) // Add your where condition here
            ->get();


        return view('accesscontrol', compact('replyslipsjoinscholarenrolled'));
    }

    public function accesscontroldeferredview(){

        $replyslipsjoinscholardeferred = replyslips::join('scholars', 'replyslips.scholar_id', '=', 'scholars.id')
            ->join('scholar_status', 'scholars.scholar_status_id', '=', 'scholar_status.id')
            ->select('replyslips.*', 'scholars.*', 'scholar_status.*')
            ->where('scholar_status_id', '=', 2) // Add your where condition here
            ->get();


        return view('accesscontrol', compact('replyslipsjoinscholardeferred'));
    }

    public function accesscontrolLOAview(){

        $replyslipsjoinscholarLOA = replyslips::join('scholars', 'replyslips.scholar_id', '=', 'scholars.id')
            ->join('scholar_status', 'scholars.scholar_status_id', '=', 'scholar_status.id')
            ->select('replyslips.*', 'scholars.*', 'scholar_status.*')
            ->where('scholar_status_id', '=', 2) // Add your where condition here
            ->get();


        return view('accesscontrol', compact('replyslipsjoinscholarLOA'));
    }

    public function accesscontrolterminatedview(){

        $replyslipsjoinscholarterminated = replyslips::join('scholars', 'replyslips.scholar_id', '=', 'scholars.id')
            ->join('scholar_status', 'scholars.scholar_status_id', '=', 'scholar_status.id')
            ->select('replyslips.*', 'scholars.*', 'scholar_status.*')
            ->where('scholar_status_id', '=', 2) // Add your where condition here
            ->get();


        return view('accesscontrol', compact('replyslipsjoinscholarterminated'));
    }


}
