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
        Schema::create('elderlys', function (Blueprint $table) {
            $table->id('ID_Elderly');
            $table->string('Name_Elderly');
            $table->date('Birthday');
            $table->text('Address');
            $table->unsignedBigInteger('ID_Address');
            $table->string('Latitude_position');
            $table->string('Longitude_position');
            $table->bigInteger('Phone_Elderly');


        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('elderlys');
    }
};
