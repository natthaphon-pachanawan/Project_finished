<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
//////////////////////////หน้าหลัก///////////////////////
    public function Homepage()
    {
        return view('dashboard');
    }
/////////////////////////////////////////////////////////
    public function login()
    {
        return view('login.login');
    }
    public function loginUser(Request $request)
    {
        $request->validate([
            'login' => 'required',
            'password' => 'required',
        ]);

        $fieldType = filter_var($request->login, FILTER_VALIDATE_EMAIL) ? 'Email' : 'Username';
        $user = User::where($fieldType, $request->login)->first();

        if ($user && Hash::check($request->password, $user->Password)) {
            $request->session()->put('loginUser', $user->ID_User);


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

/////////////////////เช็คว่าอยู่บัญชีไหน////////////////////////////////////
    public function getUserAccount(Request $request)
    {
    $userId = $request->session()->get('loginUser');
    $user = User::find($userId);

    return $user;
    }
////////////////////////////ล็อกเอ้า/////////////////////////////
    public function logout(Request $request)
    {
        if(Session::has('loginUser')){
            Session::pull('loginUser');
            return redirect('login');
        }
    }
/////////////////////////////////////////////////////////
}
