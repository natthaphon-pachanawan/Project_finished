<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Elderly extends Model
{
    protected $table = 'elderlys';
    protected $primaryKey = 'ID_Elderly';
    protected $fillable = [
        'Name_Elderly', 'Birthday', 'Address', 'ID_Address', 'Latitude_position',
        'Longitude_position', 'Phone_Elderly'
    ];
    public $timestamps = false;





}

