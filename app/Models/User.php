<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Auth\Authenticatable;
use Illuminate\Foundation\Auth\Access\Authorizable;

class User extends Model implements AuthenticatableContract
{
    use Authenticatable, Notifiable, Authorizable;

    protected $table = 'users'; // ชื่อตาราง
    protected $primaryKey = 'ID_User'; // primary key ที่คุณกำหนดในฐานข้อมูล
    protected $fillable = [
        'Username', 'Password', 'ID_Personnel', 'Type_Personnel',
        'Name_User', 'Email', 'Address', 'Phone', 'Image_User'
    ];
    public $timestamps = false;

    protected $hidden = [
        'Password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
