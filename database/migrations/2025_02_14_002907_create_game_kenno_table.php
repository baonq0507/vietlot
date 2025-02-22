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
        Schema::create('game_kenno', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['kenno5p', 'kenno3p', 'kenno1p', 'xucxac3p', 'xucxac5p', 'xoso3p', 'xoso5p']);
            $table->string('code')->nullable();
            $table->string('description')->nullable();
            $table->timestamp('start_time');
            $table->timestamp('end_time');
            $table->json('result')->nullable();
            $table->enum('status', ['not_started', 'running', 'completed']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('game_kenno');
    }
};
