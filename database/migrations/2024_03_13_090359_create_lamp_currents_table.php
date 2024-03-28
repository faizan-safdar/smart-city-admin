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
        Schema::create('lamp_currents', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('lamp_id');
            $table->double('now');
            $table->double('min');
            $table->double('max');
            $table->double('avg');
            $table->foreign('lamp_id')->references('id')->on('street_lights')->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lamp_currents');
    }
};
