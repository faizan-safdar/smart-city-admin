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
        Schema::create('traffic_signal_ones', function (Blueprint $table) {
            $table->id();
            $table->integer('l1_current_vehicles');
            $table->integer('l1_max_vehicles');
            $table->string('l1_traffic_text');
            $table->integer('l2_current_vehicles');
            $table->integer('l2_max_vehicles');
            $table->string('l2_traffic_text');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('traffic_signal_ones');
    }
};
