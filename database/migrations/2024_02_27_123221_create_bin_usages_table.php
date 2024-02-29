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
        Schema::create('bin_usages', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('dustbin_id');
            $table->integer('eighth_1');
            $table->integer('eighth_2');
            $table->integer('eighth_3');
            $table->integer('eighth_4');
            $table->integer('eighth_5');
            $table->integer('eighth_6');
            $table->foreign('dustbin_id')->references('id')->on('dustbins')->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bin_usages');
    }
};
