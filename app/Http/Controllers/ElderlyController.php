<?php

namespace App\Http\Controllers;

use App\Models\Elderly;
use App\Models\AddressElderly;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class ElderlyController extends Controller
{
    public function Addelderly()
    {
        return view('staff.elderly.addelderly');
    }

    public function Storeelderly(Request $request)
    {
        $request->validate([
            'Name_Elderly' => 'required|string|max:255',
            'Birthday' => 'required|date',
            'Address' => 'required|string',
            'Phone_Elderly' => 'required|string',
            'Image_Elderly' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        $elderly = new Elderly();
        $elderly->fill($request->only(['Name_Elderly', 'Birthday', 'Address', 'Phone_Elderly']));

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

    public function Showelderly(Request $request)
    {
        $search = $request->get('search');

        $elderlies = Elderly::when($search, function ($query, $search) {
            return $query->where('Name_Elderly', 'LIKE', "%$search%");
        })->paginate(10);


        $ageGroups = [
            '60-69' => 0,
            '70-79' => 0,
            '80-89' => 0,
            '90+' => 0,
        ];

        foreach ($elderlies as $elderly) {
            $age = Carbon::parse($elderly->Birthday)->age;
            if ($age >= 60 && $age <= 69) {
                $ageGroups['60-69']++;
            } elseif ($age >= 70 && $age <= 79) {
                $ageGroups['70-79']++;
            } elseif ($age >= 80 && $age <= 89) {
                $ageGroups['80-89']++;
            } elseif ($age >= 90) {
                $ageGroups['90+']++;
            }
        }

        return view('staff.dashboard-staff', compact('elderlies', 'ageGroups'));
    }

    public function Editelderly($id)
    {
        $elderly = Elderly::findOrFail($id);
        $addressElderly = AddressElderly::where('ID_Elderly', $id)->first();
        return view('staff.elderly.editelderly', compact('elderly', 'addressElderly'));
    }

    public function Updateelderly(Request $request, $id)
    {
        $elderly = Elderly::findOrFail($id);

        $request->validate([
            'Name_Elderly' => 'required|string|max:255',
            'Birthday' => 'required|date',
            'Address' => 'required|string',
            'Phone_Elderly' => 'required|string',
            'Image_Elderly' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        $elderly->fill($request->only(['Name_Elderly', 'Birthday', 'Address', 'Phone_Elderly']));

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
        if (!$addressElderly) {
            $addressElderly = new AddressElderly();
            $addressElderly->ID_Elderly = $id;
        }
        $addressElderly->Latitude_position = $request->input('Latitude_position');
        $addressElderly->Longitude_position = $request->input('Longitude_position');
        $addressElderly->save();

        return redirect()->route('staff-dashboard')->with('success', 'Elderly information updated successfully.');
    }

    public function Deleteelderly($id)
    {
        $elderly = Elderly::findOrFail($id);

        // Delete image
        if ($elderly->Image_Elderly) {
            Storage::disk('public')->delete($elderly->Image_Elderly);
        }

        $elderly->delete();

        return redirect()->route('staff-dashboard')->with('success', 'Elderly information deleted successfully.');
    }

    public function searchLocation($id)
    {
        $addressElderly = AddressElderly::where('ID_Elderly', $id)->firstOrFail();
        $latitude = $addressElderly->Latitude_position;
        $longitude = $addressElderly->Longitude_position;

        return redirect()->away("https://www.google.com/maps/search/?api=1&query=$latitude,$longitude");
    }


}
