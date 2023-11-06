<?php

namespace App\Http\Controllers;

use App\Models\Rsms;
use App\Models\Rsms_ra7687s;
use App\Models\Rsms_ra10612s;
use App\Models\Rsms_merits;
use App\Models\Rsms_noncompliance;
use Illuminate\Http\Request;

class RsmsViewController extends Controller
{
    //
    public function rsmsview()
    {
        $rsms1 = Rsms::all();
        return view('rsms', compact('rsms1'));
    }

    public function rsmsviewfixed()
    {
        $rsms1 = Rsms::all();
        return view('rsms', compact('rsms1'));
    }

    public function rsmslistra7687view()
    {
        $rsmsra7687 = Rsms_ra7687s::all();
        return view('rsmslistra7687', compact('rsmsra7687'));
    }

    public function rsmslistra10612view()
    {
        $rsmsra10612 = Rsms_ra10612s::all();
        return view('rsmslistra10612', compact('rsmsra10612'));
    }

    public function rsmslistmeritview()
    {
        $rsmsmerit = Rsms_merits::all();
        return view('rsmslistmerit', compact('rsmsmerit'));
    }

    public function rsmslistnoncomplianceview()
    {
        $rsmsnoncompliance = Rsms_noncompliance::all();
        return view('rsmslistnoncompliance', compact('rsmsnoncompliance'));
    }
}
