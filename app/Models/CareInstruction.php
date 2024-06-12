<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CareInstruction extends Model
{
    protected $table = 'care_instructions';
    protected $fillable = [
        'ID_Elderly', 'Name_Elderly', 'Care_instructions'
    ];
    public $timestamps = false;

}

