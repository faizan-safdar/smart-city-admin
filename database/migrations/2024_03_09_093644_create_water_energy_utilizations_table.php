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
        Schema::create('water_energy_utilizations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('water_id');
            $table->integer('eighth_1');
            $table->integer('eighth_2');
            $table->integer('eighth_3');
            $table->integer('eighth_4');
            $table->integer('eighth_5');
            $table->integer('eighth_6');
            $table->foreign('water_id')->references('id')->on('water_management')->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('water_energy_utilizations');
    }
};
