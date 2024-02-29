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
        Schema::create('bin_waste_breakdowns', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('dustbin_id');
            $table->integer('organic_waste');
            $table->integer('bottles_cans');
            $table->integer('paper_packaging');
            $table->integer('cardboard');
            $table->integer('other_waste');
            $table->foreign('dustbin_id')->references('id')->on('dustbins')->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bin_waste_breakdowns');
    }
};
