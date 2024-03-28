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
        Schema::create('water_management', function (Blueprint $table) {
            $table->id();
            $table->string('level_name');
            $table->integer('current_capacity');
            $table->integer('max_capacity');
            $table->string('level_status');
            $table->dateTime('time');
            $table->string('alarm_status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('water_management');
    }
};
