<?php

namespace App\Http\Controllers;

use App\Models\Rsms;
use App\Models\Rsms_ra7687s;
use Illuminate\Http\Request;

class RsmsViewController extends Controller
{
    //
    public function rsmsview(){
        $rsms1 = Rsms::all();
        return view('rsms', compact('rsms1'));
    }

    public function rsmslistra7687view(){
        $rsmsra7687 = Rsms_ra7687s::all();
        return view('rsmslistra7687', compact('rsmsra7687'));
    }
}
