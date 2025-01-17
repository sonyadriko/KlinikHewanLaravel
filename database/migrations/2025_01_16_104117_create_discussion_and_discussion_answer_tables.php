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
        Schema::create('discussions', function (Blueprint $table) {
            $table->id(); // id
            $table->text('discussion_content'); // isi_diskusi
            $table->unsignedBigInteger('user_id'); // user_id
            $table->timestamps(); // created_at, updated_at

            // Foreign key constraint (assuming 'users' table exists)
            $table->foreign('user_id')->references('id_users')->on('users')->onDelete('cascade');
        });

        // Create 'discussion_answers' table
        Schema::create('discussion_answers', function (Blueprint $table) {
            $table->id(); // id
            $table->unsignedBigInteger('discussion_id'); // diskusi_id
            $table->text('answer_content'); // isi_jawaban
            $table->unsignedBigInteger('user_id'); // user_id
            $table->timestamps(); // created_at, updated_at

            // Foreign key constraint (assuming 'discussions' and 'users' tables exist)
            $table->foreign('discussion_id')->references('id')->on('discussions')->onDelete('cascade');
            $table->foreign('user_id')->references('id_users')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('discussion_answers');
        Schema::dropIfExists('discussions');
    }
};
