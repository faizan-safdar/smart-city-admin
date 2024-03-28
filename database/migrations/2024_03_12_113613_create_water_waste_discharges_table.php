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
        Schema::create('water_waste_discharges', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('water_id');
            $table->integer('industrial');
            $table->integer('commercial');
            $table->integer('domestic');
            $table->integer('agriculture');
            $table->foreign('water_id')->references('id')->on('water_management')->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('water_waste_discharges');
    }
};
