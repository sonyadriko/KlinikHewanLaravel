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
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // Relationship to the users table
            $table->unsignedBigInteger('hewan_id'); // Relationship to the pets table (if applicable)
            $table->date('reservation_date');
            $table->string('reservation_slot'); // For example, number of slots or capacity
            $table->string('service_type'); // Service type, such as consultation, vaccination, etc.
            $table->string('status')->default('pending'); // Pending, confirmed, cancelled, etc.
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('hewan_id')->references('id')->on('hewans')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
