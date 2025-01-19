<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id(); // Auto-increment primary key
            $table->string('nama');
            $table->string('email')->unique(); // Unique constraint
            $table->string('password');
            $table->enum('role', ['admin', 'doctor', 'patient'])->default('patient'); // Role field
            $table->string('notelp', 13)->nullable(); // Nullable phone number
            $table->string('alamat')->nullable(); // Nullable address
            $table->timestamps(); // created_at and updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
