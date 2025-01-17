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
        Schema::create('hewan', function (Blueprint $table) {
            $table->id('id_hewan');
            $table->unsignedBigInteger('user_id');
            $table->string('nama_hewan');
            $table->string('jenis_hewan');
            $table->string('jenis_kelamin');
            $table->string('ras_hewan');
            $table->timestamps();
            
            $table->foreign('user_id')->references('id_users')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hewan');
    }
};
