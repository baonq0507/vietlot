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
        Schema::create('setting_xxes', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['xucxac3p', 'xucxac5p']);
            $table->float('reward_win');
            $table->float('reward_win_2');
            $table->float('reward_win_3');
            $table->float('reward_win_2_every');
            $table->float('reward_win_3_every');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('setting_xxes');
    }
};
