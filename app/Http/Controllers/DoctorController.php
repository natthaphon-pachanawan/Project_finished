<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BarthelAdl;
use App\Models\CareGiver;
use App\Models\Elderly;
use App\Models\CareInstruction;
use Carbon\Carbon;

class DoctorController extends Controller
{
    public function ShowDataElderly()
    {
        $elderlys = Elderly::with('barthel_adl')->get();
        return view('doctor.dashboard-doctor', compact('elderlys'));
    }

    public function CreateCI(Request $request)
    {
        $elderly = Elderly::findOrFail($request->elderly_id);
        $careGiver = CareGiver::where('ID_Elderly', $elderly->ID_Elderly)->first();
        $reporter = $careGiver ? $careGiver->Reporter : 'Unknown';

        return view('doctor.CI.AddCI', compact('elderly', 'reporter'));
    }

    public function storeCI(Request $request)
    {
        $request->validate([
            'ID_Elderly' => 'required|exists:elderlys,ID_Elderly',
            'Date_CI' => 'required|date',
            'Name_Elderly' => 'required|string',
            'Name_Doctor' => 'required|string',
            'Name_Staff' => 'required|string',
            'Care_instructions' => 'required|string',
        ]);

        CareInstruction::create($request->all());

        return redirect()->route('doctor.dashboard')->with('success', 'คำแนะนำถูกบันทึกเรียบร้อยแล้ว');
    }

    public function ShowCI()
    {
        $careInstructions = CareInstruction::all();
        return view('doctor.CI.ShowCI', compact('careInstructions'));
    }

    public function DestroyCI($id)
    {
        $careInstruction = CareInstruction::findOrFail($id);
        $careInstruction->delete();
        return redirect()->route('ci.index')->with('success', 'Care Instruction deleted successfully.');
    }

    public function editCI($id)
    {
        $careInstruction = CareInstruction::findOrFail($id);
        return view('doctor.CI.EditCI', compact('careInstruction'));
    }

    public function updateCI(Request $request, $id)
    {
        $request->validate([
            'ID_Elderly' => 'required|exists:elderlys,ID_Elderly',
            'Date_CI' => 'required|date',
            'Name_Elderly' => 'required|string',
            'Name_Doctor' => 'required|string',
            'Name_Staff' => 'required|string',
            'Care_instructions' => 'required|string',
        ]);

        $careInstruction = CareInstruction::findOrFail($id);
        $careInstruction->update($request->all());

        return redirect()->route('ci.index')->with('success', 'คำแนะนำถูกอัปเดตเรียบร้อยแล้ว');
    }
}
