<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('activity_caregivers', function (Blueprint $table) {
            $table->id('ID_ACG');
            $table->unsignedBigInteger('ID_CG');
            $table->date('Date_ACG');
            $table->string('Evaluate')->nullable();
            $table->string('Dress_the_wound')->nullable();
            $table->string('Rehabilitate')->nullable();
            $table->string('Clean_body')->nullable();
            $table->string('Take_care_medicine')->nullable();
            $table->string('Take_care_feeding')->nullable();
            $table->string('Environmental')->nullable();
            $table->string('Take_exercise')->nullable();
            $table->string('Give_advice_consult')->nullable();
            $table->string('Take_to_see_a_doctor')->nullable();
            $table->string('Other')->nullable();
            $table->string('Take_to_make_merit')->nullable();
            $table->string('Take_to_market')->nullable();
            $table->string('Take_to_meet_friends')->nullable();
            $table->string('Take_to_allowance')->nullable();
            $table->string('Talk_as_friends')->nullable();
            $table->string('Other_specified')->nullable();
            $table->string('Problem')->nullable();
            $table->string('Troubleshoot')->nullable();
            $table->foreign('ID_CG')->references('ID_CG')->on('care_givers')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('activity_caregivers');
    }
};
