<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{

    public function login()
    {
        return view('login.login');
    }
    public function loginUser(Request $request)
    {
        // Validate the input fields
        $request->validate([
            'login' => 'required',
            'password' => 'required',
        ]);

        // Determine if the login input is an email or username
        $fieldType = filter_var($request->login, FILTER_VALIDATE_EMAIL) ? 'Email' : 'Username';
        $user = User::where($fieldType, $request->login)->first();


        // Check if user exists
        if (!$user) {
            return back()->with('fail', 'No account found with this email or username.');
        }

        // Verify password and login user
        if (Hash::check($request->password, $user->Password)) {
            Auth::login($user);

            // Redirect the user based on their role
            switch ($user->Type_Personnel) {
                case 'Admin':
                    return redirect()->intended('admin-dashboard');
                case 'Doctor':
                    return redirect()->intended('doctor-dashboard');
                default:
                    return redirect()->intended('staff-dashboard');
            }
        }

        // If password is incorrect, return with error
        return back()->with('fail', 'Incorrect password.');
    }


    ////////////////////////////ล็อกเอ้า/////////////////////////////
    public function logout(Request $request)
{
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('login')->with('success', 'You have been logged out successfully.');
}


    /////////////////////////////////////////////////////////
}
