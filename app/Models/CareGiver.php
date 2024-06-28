<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CareGiver extends Model
{
    use HasFactory;

    protected $table = 'care_givers';
    protected $primaryKey = 'ID_CG';
    protected $fillable = [
        'ID_ADL', 'ID_Elderly', 'Name_CG', 'Name_Elderly',
        'Birthday', 'Weight', 'Height', 'Waist', 'Address', 'Group_ADL',
        'Disease', 'Disability', 'Rights', 'Caretaker', 'Related',
        'Phone_Caretaker', 'Date_CG', 'Consciousness', 'Vital_signs',
        'Bedsores', 'Pain', 'Swelling', 'Itchy_rash', 'Stiff_joints',
        'Malnutrition', 'Eating', 'Swallowing', 'Defecation',
        'Urinary_excretion', 'Taking_medicine', 'Emotional_state',
        'Economic_problems', 'Social_problems', 'Doctor_FU',
        'Other_problems', 'Assistance', 'Reporter'
    ];

    public $timestamps = false;

    public function activities()
    {
        return $this->hasMany(ActivityCaregiver::class, 'ID_CG', 'ID_CG');
    }
}
