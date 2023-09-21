<?php

namespace App\Http\Controllers;

use App\Models\replyslips;
use App\Models\Scholars;
use Illuminate\Support\Facades\DB;

use App\Models\Sei;
use Illuminate\Http\Request;
use MongoDB\Driver\Monitoring\ServerChangedEvent;

class EmailStatusViewController extends Controller
{
    //
    public function index()
    {
        $replyslips = replyslips::with('scholars')
            ->select('scholar_id', DB::raw('MAX(id) as max_id'))
            ->where('replyslip_status_id', 1)
            ->groupBy('scholar_id')
            ->get();

       // $groupedReplySlips = $replyslips->groupBy('scholar_id');

        return view('emails', compact('replyslips'));
    }
}
