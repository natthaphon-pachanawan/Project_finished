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
        'Username',
        'Password',
        'ID_Personnel',
        'Type_Personnel',
        'Name_User',
        'Type_Doctor',
        'Email',
        'Address',
        'Phone',
        'Image_User'
    ];
    public $timestamps = false;

    protected $hidden = [
        'Password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    const TYPE_ADMIN = 'Admin';
    const TYPE_DOCTOR = 'Doctor';
    const TYPE_STAFF = 'Staff'; // Conceptualized as Nurse

    public function isAdmin()
    {
        return $this->Type_Personnel === self::TYPE_ADMIN;
    }

    public function isDoctor()
    {
        return $this->Type_Personnel === self::TYPE_DOCTOR;
    }

    public function isNurse()
    {
        return $this->Type_Personnel === self::TYPE_STAFF;
    }

    public function barthel_adls()
    {
        return $this->hasMany(BarthelAdl::class, 'ID_User', 'ID_User');
    }
}
