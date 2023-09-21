<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Sei;


class SeiPotentialQualifierviewController extends Controller
{
    //
    public function index()
    {
        $seis = Sei::with('scholars')
        ->where('lacking', '!=', '')
        ->get();
        return view('seilist2', compact('seis'));
    }

}
