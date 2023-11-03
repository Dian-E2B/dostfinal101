<?php

namespace App\Http\Controllers;

use App\Models\replyslips;
use Illuminate\Http\Request;

class AccessControlViewController extends Controller
{

    public function index()
    {
        try {
            $replyslipsjoinscholar = replyslips::join('scholars', 'replyslips.scholar_id', '=', 'scholars.id')
                ->join('scholar_status', 'scholars.scholar_status_id', '=', 'scholar_status.id')
                ->select('replyslips.*', 'scholars.*', 'scholar_status.*')
                ->get();

            return view('accesscontrol', compact('replyslipsjoinscholar'));
        } catch (\Exception $e) {

            // flash()->addError('Empty Records' . $e->getMessage());
            flash()->addError('    Empty Records');
            return redirect()->back();
        }
    }


    public function accesscontrolpendingview()
    {
        try {
            $replyslipsjoinscholarpending = replyslips::join('scholars', 'replyslips.scholar_id', '=', 'scholars.id')
                ->join('scholar_status', 'scholars.scholar_status_id', '=', 'scholar_status.id')
                ->select('replyslips.*', 'scholars.*', 'scholar_status.*')
                ->where('scholar_status_id', '=', 1) // Add your where condition here
                ->get();
            return view('accesscontrol', compact('replyslipsjoinscholarpending'));
        } catch (\Exception $e) {
            flash()->addError('    Empty Records');
            return redirect()->back();
        }
    }

    public function accesscontrolongoingview()
    {

        $replyslipsjoinscholarongoing = replyslips::join('scholars', 'replyslips.scholar_id', '=', 'scholars.id')
            ->join('scholar_status', 'scholars.scholar_status_id', '=', 'scholar_status.id')
            ->select('replyslips.*', 'scholars.*', 'scholar_status.*')
            ->where('scholar_status_id', '=', 2) // Add your where condition here
            ->get();


        return view('accesscontrol', compact('replyslipsjoinscholarongoing'));
    }

    public function accesscontrolenrolledview()
    {

        try {
            $replyslipsjoinscholarenrolled = replyslips::join('scholars', 'replyslips.scholar_id', '=', 'scholars.id')
                ->join('scholar_status', 'scholars.scholar_status_id', '=', 'scholar_status.id')
                ->select('replyslips.*', 'scholars.*', 'scholar_status.*')
                ->where('scholar_status_id', '=', 3) // Add your where condition here
                ->get();
            return view('accesscontrol', compact('replyslipsjoinscholarenrolled'));
        } catch (\Exception $e) {
            flash()->addError('Empty Records');
            return redirect()->back();
        }
    }

    public function accesscontroldeferredview()
    {

        try {
            $replyslipsjoinscholardeferred = replyslips::join('scholars', 'replyslips.scholar_id', '=', 'scholars.id')
                ->join('scholar_status', 'scholars.scholar_status_id', '=', 'scholar_status.id')
                ->select('replyslips.*', 'scholars.*', 'scholar_status.*')
                ->where('scholar_status_id', '=', 4) // Add your where condition here
                ->get();
            return view('accesscontrol', compact('replyslipsjoinscholardeferred'));
        } catch (\Exception $e) {
            flash()->addError('Empty Records');
            return redirect()->back();
        }
    }

    public function accesscontrolLOAview()
    {

        try {
            $replyslipsjoinscholarLOA = replyslips::join('scholars', 'replyslips.scholar_id', '=', 'scholars.id')
                ->join('scholar_status', 'scholars.scholar_status_id', '=', 'scholar_status.id')
                ->select('replyslips.*', 'scholars.*', 'scholar_status.*')
                ->where('scholar_status_id', '=', 5) // Add your where condition here
                ->get();
            return view('accesscontrol', compact('replyslipsjoinscholarLOA'));
        } catch (\Exception $e) {
            flash()->addError('Empty Records');
            return redirect()->back();
        }
    }

    public function accesscontrolterminatedview()
    {

        try {
            $replyslipsjoinscholarterminated = replyslips::join('scholars', 'replyslips.scholar_id', '=', 'scholars.id')
                ->join('scholar_status', 'scholars.scholar_status_id', '=', 'scholar_status.id')
                ->select('replyslips.*', 'scholars.*', 'scholar_status.*')
                ->where('scholar_status_id', '=', 6) // Add your where condition here
                ->get();
            return view('accesscontrol', compact('replyslipsjoinscholarterminated'));
        } catch (\Exception $e) {
            flash()->addError('Empty Records');
            return redirect()->back();
        }
    }
}
