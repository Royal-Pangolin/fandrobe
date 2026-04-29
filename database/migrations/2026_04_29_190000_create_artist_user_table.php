<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Tabla pivot para artistas seguidos por los usuarios.
     */
    public function up(): void
    {
        Schema::create('artist_user', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('artist_id')->constrained('artists')->cascadeOnDelete();
            $table->timestamp('followed_at')->useCurrent();
            $table->unique(['user_id', 'artist_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('artist_user');
    }
};
