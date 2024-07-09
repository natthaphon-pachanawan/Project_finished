<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Personnel;

class AdminController extends Controller
{
    public function showAdmin()
    {
        $users = User::all();
        return view('admin.dashboard-admin', compact('users'));
    }

    public function registerUser()
    {
        $personnelTypes = Personnel::where('Type_Personnel', '!=', 'Admin')->get();
        return view('admin.register-user', compact('personnelTypes'));
    }

    public function submitUser(Request $request)
    {
        $request->validate([
            'Username' => 'required|unique:users,Username|max:255',
            'Password' => 'required|min:6',
            'Type_Personnel' => 'required'
        ]);

        $personnel = Personnel::find($request->Type_Personnel);

        if (!$personnel) {
            return redirect()->route('user.register')->with('error', 'Invalid personnel type selected.');
        }

        $user = new User();
        $user->Username = $request->Username;
        $user->Password = Hash::make($request->Password);
        $user->ID_Personnel = $personnel->ID_Personnel;
        $user->Type_Personnel = $personnel->Type_Personnel;
        $user->Name_User = '';
        $user->Email = '';
        $user->Address = '';
        $user->Phone = '';
        $user->Image_User = '';

        $user->save();

        return redirect()->route('user.register')->with('success', 'User registered successfully!');
    }


    public function deleteUser($id)
    {
        $user = User::find($id);
        if ($user->Type_Personnel !== 'Admin') {
            $user->delete();
            return redirect()->route('admin.dashboard')->with('success', 'User deleted successfully!');
        } else {
            return redirect()->route('admin.dashboard')->with('error', 'Admin accounts cannot be deleted.');
        }
    }
}
