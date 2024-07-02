<?php

namespace App\Http\Controllers;

use App\Models\Elderly;
use App\Models\AddressElderly;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ElderlyController extends Controller {
    public function Addelderly() {
        return view('staff.elderly.addelderly');
    }

    public function Storeelderly(Request $request) {
        $request->validate([
            'Name_Elderly' => 'required|string|max:255',
            'Birthday' => 'required|date',
            'Address' => 'required|string',
            'Phone_Elderly' => 'required|string',
            'Image_Elderly' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        $elderly = new Elderly();
        $elderly->Name_Elderly = $request->input('Name_Elderly');
        $elderly->Birthday = $request->input('Birthday');
        $elderly->Address = $request->input('Address');
        $elderly->Phone_Elderly = $request->input('Phone_Elderly');

        if ($request->hasFile('Image_Elderly')) {
            $imagePath = $request->file('Image_Elderly')->store('elderly_images', 'public');
            $elderly->Image_Elderly = $imagePath;
        }

        $elderly->save();

        $addressElderly = new AddressElderly();
        $addressElderly->ID_Elderly = $elderly->ID_Elderly;
        $addressElderly->Name_Elderly = $elderly->Name_Elderly;
        $addressElderly->Latitude_position = $request->input('Latitude_position');
        $addressElderly->Longitude_position = $request->input('Longitude_position');
        $addressElderly->save();

        return redirect()->back()->with('success', 'Elderly information added successfully.');
    }

    public function Showelderly() {
        $elderlies = Elderly::all();
        return view('staff.dashboard-staff', compact('elderlies'));
    }

    public function Editelderly($id) {
        $elderly = Elderly::findOrFail($id);
        $addressElderly = AddressElderly::where('ID_Elderly', $id)->first();
        return view('staff.elderly.editelderly', compact('elderly', 'addressElderly'));
    }

    public function Updateelderly(Request $request, $id) {
        $elderly = Elderly::findOrFail($id);

        $request->validate([
            'Name_Elderly' => 'required|string|max:255',
            'Birthday' => 'required|date',
            'Address' => 'required|string',
            'Phone_Elderly' => 'required|string',
            'Image_Elderly' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        $elderly->Name_Elderly = $request->input('Name_Elderly');
        $elderly->Birthday = $request->input('Birthday');
        $elderly->Address = $request->input('Address');
        $elderly->Phone_Elderly = $request->input('Phone_Elderly');

        if ($request->hasFile('Image_Elderly')) {
            // Delete old image
            if ($elderly->Image_Elderly) {
                Storage::disk('public')->delete($elderly->Image_Elderly);
            }

            $imagePath = $request->file('Image_Elderly')->store('elderly_images', 'public');
            $elderly->Image_Elderly = $imagePath;
        }

        $elderly->save();

        $addressElderly = AddressElderly::where('ID_Elderly', $id)->first();
        $addressElderly->Latitude_position = $request->input('Latitude_position');
        $addressElderly->Longitude_position = $request->input('Longitude_position');
        $addressElderly->save();

        return redirect()->route('staff-dashboard')->with('success', 'Elderly information updated successfully.');
    }

    public function Deleteelderly($id) {
        $elderly = Elderly::findOrFail($id);

        // Delete image
        if ($elderly->Image_Elderly) {
            Storage::disk('public')->delete($elderly->Image_Elderly);
        }

        $elderly->delete();

        return redirect()->route('staff-dashboard')->with('success', 'Elderly information deleted successfully.');
    }
}
