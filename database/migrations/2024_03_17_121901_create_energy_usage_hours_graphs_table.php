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
        Schema::create('energy_usage_hours_graphs', function (Blueprint $table) {
          $table->id();
          $table->unsignedBigInteger('energy_id');
          $table->double('eighth_1');
          $table->double('eighth_2');
          $table->double('eighth_3');
          $table->double('eighth_4');
          $table->double('eighth_5');
          $table->double('eighth_6');
          $table->foreign('energy_id')->references('id')->on('energies')->onUpdate('cascade')->onDelete('cascade');
          $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('energy_usage_hours_graphs');
    }
};
