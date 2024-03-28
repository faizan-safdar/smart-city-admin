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
        Schema::create('energy_connection_types', function (Blueprint $table) {
          $table->id();
          $table->unsignedBigInteger('energy_id');
          $table->double('power');
          $table->double('acmv');
          $table->double('elec_esc');
          $table->double('lightning');
          $table->double('mixed_load');
          $table->foreign('energy_id')->references('id')->on('energies')->onUpdate('cascade')->onDelete('cascade');
          $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('energy_connection_types');
    }
};
