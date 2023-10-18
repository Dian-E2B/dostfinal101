<?php

namespace App\Http\Controllers;

use App\Models\Rsms;
use Illuminate\Http\Request;

class RsmsViewController extends Controller
{
    //
    public function rsmsview(){
        $rsms1 = Rsms::all();
      /*  return view('seilist2', compact('seis'));*/
        return view('rsms', compact('rsms1'));
    }
}
