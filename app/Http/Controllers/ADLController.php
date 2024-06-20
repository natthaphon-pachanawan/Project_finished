<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ADLController extends Controller
{
    public function ADL()
    {
        return view('staff.ADL');
    }
    public function summaryADL()
    {
        return view('doctor.summaryADL');
    }
}
