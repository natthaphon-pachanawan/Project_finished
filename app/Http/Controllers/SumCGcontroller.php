<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CareGiver;

class SumCGcontroller extends Controller
{
    public function Showelderly()
    {
        $Elderlys = CareGiver::all();
        return view('doctor.Sm.SummaryCG', ['Elderlys' =>$Elderlys]);
    }
}
