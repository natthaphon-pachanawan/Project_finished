<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Personnel;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function addUser()
    {
        // $personnel = Personnel::where('Type_Personnel', 'Admin')->first();
        // if (!$personnel) {
        //     return response()->json(['message' => 'Personnel ไม่พบ'], 404);
        // }
        // $user = new User();
        // $user->Username = 'admin';
        // $user->Email = 'admin@gmail.com';
        // $user->Password = Hash::make('admin');
        // $user->ID_Personnel = $personnel->ID_Personnel;
        // $user->Type_Personnel = 'Admin';
        // $user->save();
        // return response()->json(['message' => 'User ถูกเพิ่มเรียบร้อยแล้ว'], 201);
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        $personnel = Personnel::where('Type_Personnel', 'Staff')->first();
        if (!$personnel) {
            return response()->json(['message' => 'Personnel ไม่พบ'], 404);
        }
        $user = new User();
        $user->Username = 'staff';
        $user->Email = 'staff@gmail.com';
        $user->Password = Hash::make('staff');
        $user->ID_Personnel = $personnel->ID_Personnel;
        $user->Type_Personnel = 'Staff';
        $user->save();
        return response()->json(['message' => 'User ถูกเพิ่มเรียบร้อยแล้ว'], 201);
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        // $personnel = Personnel::where('Type_Personnel', 'Doctor')->first();
        // if (!$personnel) {
        //     return response()->json(['message' => 'Personnel ไม่พบ'], 404);
        // }
        // $user = new User();
        // $user->Username = 'doctor';
        // $user->Email = 'doctor@gmail.com';
        // $user->Password = Hash::make('doctor');
        // $user->ID_Personnel = $personnel->ID_Personnel;
        // $user->Type_Personnel = 'Doctor';
        // $user->save();
        // return response()->json(['message' => 'User ถูกเพิ่มเรียบร้อยแล้ว'], 201);
    }
}
