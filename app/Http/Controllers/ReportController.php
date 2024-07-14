<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CareGiver;
use App\Models\Elderly;
class ReportController extends Controller
{
    public function Dashboard_Report()
    {
        $reports = CareGiver::all();
        return view('doctor.report.Dashboard', ['reports' =>$reports ]);
    }
}
