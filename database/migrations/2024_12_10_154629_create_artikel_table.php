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
        Schema::create('artikel', function (Blueprint $table) {
            $table->id('id_artikel'); // Primary key
            $table->string('image', 255)->nullable(); // Nullable image field
            $table->string('judul', 255); // Title field
            $table->text('isi'); // Content field
            $table->string('penulis', 255); // Author field
            $table->timestamps(); // created_at and updated_at
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('artikel');
    }
};
