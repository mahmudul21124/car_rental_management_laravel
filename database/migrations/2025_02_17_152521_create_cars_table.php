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
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->integer('driver_id');
            $table->string('brand');
            $table->string('model');
            $table->string('engine');
            $table->integer('fare_per_day');
            $table->string('photo');
            $table->string('seating_capacity');
            $table->enum('status', ['available', 'unavailable', 'on_trip'])->default('available');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cars');
    }
};
