<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('activity_caregivers', function (Blueprint $table) {
            $table->id('ID_ACG');
            $table->date('Date_ACG');
            $table->integer('Evaluate');
            $table->integer('Dress_the_wound');
            $table->integer('Rehabilitate');
            $table->integer('Clean_body');
            $table->integer('Take_care_medicine');
            $table->integer('Take_care_feeding');
            $table->integer('Environmental');
            $table->integer('Take_exercise');
            $table->integer('Give_advice/consult');
            $table->integer('Take_to_see_a_doctor');
            $table->integer('Take_to_make_merit');
            $table->integer('Take_to_market');
            $table->integer('Take_to_meet_friends');
            $table->integer('Take_to_allowance');
            $table->integer('Talk_as_friends');
            $table->string('Other_specified');
            $table->string('Problem');
            $table->string('Troubleshoot');
   
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activity_caregivers');
    }
};
