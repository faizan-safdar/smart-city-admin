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
        Schema::create('water_electricity_consumptions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('water_id');
            $table->string('month');
            $table->string('room_name');
            $table->integer('energy_usage');
            $table->foreign('water_id')->references('id')->on('water_management')->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('water_electricity_consumptions');
    }
};
