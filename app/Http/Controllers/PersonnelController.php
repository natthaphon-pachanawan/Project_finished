<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Personnel;

class PersonnelController extends Controller
{

    public function addPersonnelTypes()
    {
        $types = ['Admin', 'Staff', 'Doctor'];

        foreach ($types as $type) {
            $personnel = new Personnel();
            $personnel->Type_Personnel = $type;
            $personnel->save();
        }

        return response()->json([
            'message' => 'ประเภทของ Personnel ถูกเพิ่มเรียบร้อยแล้ว'
        ]);
    }
}
