<?php

namespace App\Http\Controllers;

use App\Models\Elderly;
use Illuminate\Http\Request;

class ElderlyController extends Controller
{
    public function Addelderly()
    {
        return view('staff.elderly.addelderly');
    }

    public function Storeelderly(Request $request)
    {
        $elderly = new Elderly();
        $elderly->Name_Elderly = $request->input('Name_Elderly');
        $elderly->Birthday = $request->input('Birthday');
        $elderly->Address = $request->input('Address');
        $elderly->Latitude_position = $request->input('Latitude_position') ?? null;
        $elderly->Longitude_position = $request->input('Longitude_position') ?? null;
        $elderly->Phone_Elderly = $request->input('Phone_Elderly');
        $elderly->save();

        return redirect()->back()->with('success', 'Elderly information added successfully.');
    }

    public function Showelderly()
    {
        $elderlies = Elderly::all();
        return view('staff.dashboard-staff', compact('elderlies'));
    }

    public function Editelderly($id)
    {
        $elderly = Elderly::findOrFail($id);
        return view('staff.elderly.editelderly', compact('elderly'));
    }

    public function Updateelderly(Request $request, $id)
    {
        $elderly = Elderly::findOrFail($id);
        $elderly->Name_Elderly = $request->input('Name_Elderly');
        $elderly->Birthday = $request->input('Birthday');
        $elderly->Address = $request->input('Address');
        $elderly->Latitude_position = $request->input('Latitude_position') ?? null;
        $elderly->Longitude_position = $request->input('Longitude_position') ?? null;
        $elderly->Phone_Elderly = $request->input('Phone_Elderly');
        $elderly->save();

        return redirect()->route('staff-dashboard')->with('success', 'Elderly information updated successfully.');
    }

    public function Deleteelderly($id)
    {
        $elderly = Elderly::findOrFail($id);
        $elderly->delete();

        return redirect()->route('staff-dashboard')->with('success', 'Elderly information deleted successfully.');
    }
}
