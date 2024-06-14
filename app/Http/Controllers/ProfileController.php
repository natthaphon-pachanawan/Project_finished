<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class ProfileController extends Controller
{
    public function showProfile()
    {
        $user = Auth::user();
        return view('staff.profile-staff', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();
        $request->validate([
            'Name_User' => 'required|string|max:255',
            'Email' => 'required|string|email|max:255',
            'Address' => 'nullable|string|max:255',
            'Phone' => 'nullable|string|max:20',
            'Image_User' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $user->Name_User = $request->Name_User;
        $user->Email = $request->Email;
        $user->Address = $request->Address;
        $user->Phone = $request->Phone;

        if ($request->hasFile('Image_User')) {
            $imageName = time().'.'.$request->Image_User->extension();
            $request->Image_User->move(public_path('images'), $imageName);
            $user->Image_User = '/images/'.$imageName;
        }

        $user->save();

        return redirect()->route('profile.show')->with('success', 'Profile updated successfully');
    }
}


