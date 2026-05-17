<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('player_votes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('match_id')->constrained('matches')->cascadeOnDelete();
            $table->foreignId('player_id')->constrained()->cascadeOnDelete();
            $table->foreignId('voted_by_user_id')->constrained('users')->cascadeOnDelete();
            $table->unsignedTinyInteger('points');
            $table->text('reason')->nullable();
            $table->timestamps();

            $table->unique(['match_id', 'player_id', 'voted_by_user_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('player_votes');
    }
};