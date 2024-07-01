<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarthelAdl extends Model
{
    protected $table = 'barthel_adls';
    protected $primaryKey = 'ID_ADL';
    protected $fillable = [
        'ID_Elderly', 'Name_Elderly', 'ID_User', 'Name_User', 'Score_ADL', 'Group_ADL',
        'Feeding', 'Grooming', 'Transfer', 'Toilet_use', 'Mobility', 'Dressing',
        'Stairs', 'Bathing', 'Bowels', 'Bladder'
    ];
    public $timestamps = false;
    public function elderly()
    {
        return $this->belongsTo(Elderly::class, 'ID_Elderly', 'ID_Elderly');
    }
}

