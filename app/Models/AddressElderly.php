<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AddressElderly extends Model
{
    protected $table = 'address_elderlys';
    protected $fillable = [
        'ID_Elderly', 'Name_Elderly', 'Latitude position', 'Longitude position'
    ];
    public $timestamps = false;

}

