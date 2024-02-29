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
        Schema::create('bin_maintenance_costs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('dustbin_id');
            $table->integer('jan');
            $table->integer('feb');
            $table->integer('mar');
            $table->integer('apr');
            $table->integer('may');
            $table->integer('jun');
            $table->integer('jul');
            $table->integer('aug');
            $table->integer('sep');
            $table->integer('oct');
            $table->integer('nov');
            $table->integer('dec');
            $table->foreign('dustbin_id')->references('id')->on('dustbins')->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bin_maintenance_costs');
    }
};
