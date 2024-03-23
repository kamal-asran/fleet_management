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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('trip_id')->constrained('trips');
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('from_station_id')->constrained('stations');
            $table->foreignId('to_station_id')->constrained('stations');
            $table->integer('from_station_sequence_number');
            $table->integer('to_station_sequence_number');
            $table->foreignId('seat_id')->constrained('seats');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
