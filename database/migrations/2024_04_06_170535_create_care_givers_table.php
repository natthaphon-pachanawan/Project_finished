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
        Schema::create('care_givers', function (Blueprint $table) {
            $table->id('ID_CG');
            $table->unsignedBigInteger('ID_ADL');
            $table->unsignedBigInteger('ID_Elderly');
            $table->unsignedBigInteger('ID_ACG');
            $table->string('Name_CG');
            $table->string('Name_Elderly');
            $table->date('Birthday');
            $table->integer('Weight');
            $table->integer('Height');
            $table->integer('Waist');
            $table->string('Address');
            $table->string('Group_ADL');
            $table->string('Disease');
            $table->string('Disability');
            $table->string('Rights');
            $table->integer('Caretaker');
            $table->integer('Related');
            $table->bigInteger('Phone_Caretaker');
            $table->date('Date_CG');
            $table->integer('Consciousness');
            $table->integer('Vital_signs');
            $table->integer('Bedsores');
            $table->integer('Pain');
            $table->integer('Swelling');
            $table->integer('Itchy_rash');
            $table->integer('Stiff_joints');
            $table->integer('Malnutrition');
            $table->integer('Eating');
            $table->integer('Swallowing');
            $table->integer('Defecation');
            $table->integer('Urinary_excretion');
            $table->integer('Taking_medicine');
            $table->integer('Emotional_state');
            $table->integer('Economic_problems');
            $table->integer('Social_problems');
            $table->integer('Doctor_F/U');
            $table->string('Other_problems');
            $table->string('Assistance');
            $table->string('Reporter');
            $table->foreign('ID_ADL')->references('ID_ADL')->on('barthel_adls')->onDelete('cascade');
            $table->foreign('ID_Elderly')->references('ID_Elderly')->on('elderlys')->onDelete('cascade');
            $table->foreign('ID_ACG')->references('ID_ACG')->on('activity_caregivers')->onDelete('cascade');
           
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('care_givers');
    }
};
