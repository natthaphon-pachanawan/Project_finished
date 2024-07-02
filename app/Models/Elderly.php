<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Elderly extends Model
{
    use HasFactory;

    protected $table = 'elderlys';
    protected $primaryKey = 'ID_Elderly';

    protected $fillable = [
        'Name_Elderly',
        'Birthday',
        'Address',
        'Phone_Elderly',
        'Image_Elderly'
    ];

    public $timestamps = false;
}
