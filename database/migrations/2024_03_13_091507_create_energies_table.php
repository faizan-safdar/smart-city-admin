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
        Schema::create('energies', function (Blueprint $table) {
            $table->id();
            $table->integer('energy');
            $table->string('name');
            $table->string('owner_name');
            $table->dateTime('built_date');
            $table->string('built_area');
            $table->string('occupents');
            $table->integer('active_power');
            $table->integer('used_active_power');
            $table->double('total_current_hour');
            $table->double('cost');
            $table->string('co2');
            $table->string('KWH_person');
            $table->string('KWHM2');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('energies');
    }
};
