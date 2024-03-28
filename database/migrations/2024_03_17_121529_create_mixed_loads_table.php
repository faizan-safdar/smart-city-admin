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
        Schema::create('mixed_loads', function (Blueprint $table) {
          $table->id();
          $table->unsignedBigInteger('energy_id');
          $table->float('energy_intensity');
          $table->float('energy');
          $table->float('co2');
          $table->foreign('energy_id')->references('id')->on('energies')->onUpdate('cascade')->onDelete('cascade');
          $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mixed_loads');
    }
};
