<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'ID_User';
    protected $fillable = [
        'Username', 'Password', 'ID_Personnel', 'Type_Personnel',
        'Name_User', 'Email', 'Address', 'Phone', 'Image_User'
    ];
    public $timestamps = false;


}
