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
        Schema::table('water_energy_breakdowns', function (Blueprint $table) {
            $table->string('industrial');
            $table->string('commerce');
            $table->string('household');
            $table->string('transport');
            $table->string('others');
            $table->dropColumn('month');
            $table->dropColumn('room_name');
            $table->dropColumn('energy_usage');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('water_energy_breakdowns', function (Blueprint $table) {
          $table->dropColumn('industrial');
          $table->dropColumn('commerce');
          $table->dropColumn('household');
          $table->dropColumn('transport');
          $table->dropColumn('others');
          $table->string('month');
          $table->string('room_name');
          $table->string('energy_usage');
        });
    }
};
