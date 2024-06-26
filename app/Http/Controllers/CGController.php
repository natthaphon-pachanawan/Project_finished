<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Elderly;
use App\Models\BarthelAdl;
use App\Models\CareGiver;

class CGController extends Controller
{
    public function create()
    {
        $elderlies = Elderly::all();
        return view('staff.CG.AddCG', compact('elderlies'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'Name_CG' => 'required|string',
            'ID_Elderly' => 'required|exists:elderlys,ID_Elderly',
            'Age' => 'required|integer',
            'Address' => 'required|string',
            'Weight' => 'required|numeric',
            'Height' => 'required|numeric',
            'Waist' => 'required|numeric',
            'Group_ADL' => 'required|string',
            'Disease' => 'nullable|string',
            'Disability' => 'nullable|string',
            'Rights' => 'nullable|string',
            'Caretaker' => 'required|string',
            'Related' => 'required|string',
            'Phone_Caretaker' => 'required|string',
        ]);

        $cg = new CareGiver();
        $cg->fill($request->all());
        $cg->save();

        return redirect()->route('caregivers.create')->with('success', 'Care Giver added successfully!');
    }

    public function getGroupADL($elderlyId)
    {
        $adl = BarthelAdl::where('ID_Elderly', $elderlyId)->first();
        if ($adl) {
            return response()->json(['Group_ADL' => $adl->Group_ADL]);
        } else {
            return response()->json(['Group_ADL' => 'ไม่พบข้อมูล']);
        }
    }
}
