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
    Schema::table('water_average_consumptions', function (Blueprint $table) {
      $table->string('month');
      $table->string('type');
      $table->string('value');
      $table->dropColumn('industrial');
      $table->dropColumn('commercial');
      $table->dropColumn('domestic');
      $table->dropColumn('agriculture');
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::table('water_average_consumptions', function (Blueprint $table) {
      $table->dropColumn('month');
      $table->dropColumn('type');
      $table->dropColumn('value');
      $table->string('industrial');
      $table->string('commercial');
      $table->string('domestic');
      $table->string('agriculture');
    });
  }
};
