<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login()
    {
        return view('login.login');
    }
    public function loginUser(Request $request)
    {
        $request->validate([
            'login' => 'required', // Generic name for email/username
            'password' => 'required',
        ]);

        // Determine if login is email or username
        $fieldType = filter_var($request->login, FILTER_VALIDATE_EMAIL) ? 'Email' : 'Username';
        $user = User::where($fieldType, $request->login)->first();

        if ($user && Hash::check($request->password, $user->Password)) {
            $request->session()->put('loginUser', $user->ID_User);

            // Redirect based on user type
            switch ($user->Type_Personnel) {
                case 'Admin':
                    return redirect('admin-dashboard');
                case 'Staff':
                    return redirect('staff-dashboard');
                case 'Doctor':
                    return redirect('doctor-dashboard');
            }
        }

        return back()->with('fail', 'Email หรือ Username หรือ Password ไม่ถูกต้อง');
    }


}
