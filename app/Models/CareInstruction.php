<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CareInstruction extends Model
{
    protected $table = 'care_instructions';
    protected $primaryKey = 'ID_CI';
    protected $fillable = [
        'ID_Elderly', 'Date_CI', 'Name_Elderly', 'Name_Doctor', 'Name_Staff', 'Care_instructions'
    ];
    public $timestamps = false;

}

