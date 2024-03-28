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
        Schema::create('lamp_photocell_graphs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('lamp_id');
            $table->integer('hour_1');
            $table->integer('hour_2');
            $table->integer('hour_3');
            $table->integer('hour_4');
            $table->integer('hour_5');
            $table->integer('hour_6');
            $table->integer('hour_7');
            $table->integer('hour_8');
            $table->integer('hour_9');
            $table->integer('hour_10');
            $table->integer('hour_11');
            $table->integer('hour_12');
            $table->integer('hour_13');
            $table->integer('hour_14');
            $table->integer('hour_15');
            $table->integer('hour_16');
            $table->integer('hour_17');
            $table->integer('hour_18');
            $table->integer('hour_19');
            $table->integer('hour_20');
            $table->integer('hour_21');
            $table->integer('hour_22');
            $table->integer('hour_23');
            $table->integer('hour_24');
            $table->foreign('lamp_id')->references('id')->on('street_lights')->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lamp_photocell_graphs');
    }
};
