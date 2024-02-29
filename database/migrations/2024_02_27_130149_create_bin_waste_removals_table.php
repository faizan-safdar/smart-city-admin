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
        Schema::create('bin_waste_removals', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('dustbin_id');
            $table->integer('day_1');
            $table->integer('day_2');
            $table->integer('day_3');
            $table->integer('day_4');
            $table->integer('day_5');
            $table->integer('day_6');
            $table->integer('day_7');
            $table->integer('day_8');
            $table->integer('day_9');
            $table->integer('day_10');
            $table->integer('day_11');
            $table->integer('day_12');
            $table->integer('day_13');
            $table->integer('day_14');
            $table->integer('day_15');
            $table->integer('day_16');
            $table->integer('day_17');
            $table->integer('day_18');
            $table->integer('day_19');
            $table->integer('day_20');
            $table->integer('day_21');
            $table->integer('day_22');
            $table->integer('day_23');
            $table->integer('day_24');
            $table->integer('day_25');
            $table->integer('day_26');
            $table->integer('day_27');
            $table->integer('day_28');
            $table->integer('day_29');
            $table->integer('day_30');
            $table->foreign('dustbin_id')->references('id')->on('dustbins')->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bin_waste_removals');
    }
};
