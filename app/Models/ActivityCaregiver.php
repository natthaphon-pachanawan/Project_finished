<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivityCaregiver extends Model
{
    protected $table = 'activity_caregivers';
    protected $fillable = [
        'Date_ACG', 'Evaluate', 'Dress_the_wound', 'Rehabilitate', 'Clean_body',
        'Take_care_medicine', 'Take_care_feeding', 'Environmental', 'Take_exercise',
        'Give_advice/consult', 'Take_to_see_a_doctor', 'Take_to_make_merit',
        'Take_to_market', 'Take_to_meet_friends', 'Take_to_allowance', 'Talk_as_friends',
        'Other_specified', 'Problem', 'Troubleshoot'
    ];
    public $timestamps = false;
}

