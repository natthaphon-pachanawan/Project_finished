<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BarthelAdl;
use App\Models\CareGiver;
use App\Models\Elderly;
use Carbon\Carbon;

class DoctorController extends Controller
{
    public function ShowDataElderly()
    {
        $elderlys = Elderly::with('barthel_adl')->get();
        return view('doctor.dashboard-doctor', compact('elderlys'));
    }
    
    public function SumADL()
    {
        $adls = BarthelAdl::all();
        return view('doctor.Sm.SummaryADL', ['adls' => $adls]);
    }

    public function Showelderly()
    {
        $Elderlys = CareGiver::all();
        return view('doctor.Sm.SummaryCG', ['Elderlys' => $Elderlys]);
    }

    public function Dashboard_Report()
    {
        $reports = CareGiver::all();
        return view('doctor.report.Dashboard', ['reports' => $reports]);
    }

    public function Sum_report()
    {
        return view('doctor.report.reportsm');
    }
}
