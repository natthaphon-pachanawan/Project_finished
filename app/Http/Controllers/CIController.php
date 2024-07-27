<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CareInstruction;
use Carbon\Carbon;
use Auth;

class CIController extends Controller
{
    public function ShowStaffCI()
    {
        $careInstructions = CareInstruction::where('Name_Staff', Auth::user()->Name_User)->with('elderly')->get();
        return view('staff.CI.Staff-ShowCI', compact('careInstructions'));
    }

    // Method to confirm the CI
    public function confirmCI($id)
    {
        $careInstruction = CareInstruction::findOrFail($id);
        $careInstruction->update(['Confirm' => 'ยืนยัน']);

        return redirect()->route('staff.ci.index')->with('success', 'Care Instruction confirmed successfully.');
    }

    // Method to unconfirm the CI
    public function unconfirmCI($id)
    {
        $careInstruction = CareInstruction::findOrFail($id);
        $careInstruction->update(['Confirm' => null]);

        return redirect()->route('staff.ci.index')->with('success', 'Care Instruction unconfirmed successfully.');
    }

    
}
