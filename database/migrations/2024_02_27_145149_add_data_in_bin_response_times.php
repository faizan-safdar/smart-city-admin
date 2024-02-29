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
        Schema::table('bin_response_times', function (Blueprint $table) {
      $table->unsignedBigInteger('dustbin_id');
      $table->integer('1_hr');
      $table->integer('2_hr');
      $table->integer('4_hr');
      $table->integer('4_plus_hr');
      $table->foreign('dustbin_id')->references('id')->on('dustbins')->onUpdate('cascade')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bin_response_times', function (Blueprint $table) {
            //
        });
    }
};
