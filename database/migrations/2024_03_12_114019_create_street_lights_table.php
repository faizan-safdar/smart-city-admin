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
        Schema::create('street_lights', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('status')->default('false');
            $table->integer('energy_consumed');
            $table->string('schedule');
            $table->string('power_status');
            $table->string('device_status');
            $table->string('timezone');
            $table->dateTime('last_contact');
            $table->string('street_light_status');
            $table->string('lamp_status');
            $table->string('knockdown_status');
            $table->integer('brightness_level');
            $table->string('photocell_mode_on');
            $table->string('photocell_mode_off');
            $table->string('beacon_control');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('street_lights');
    }
};
