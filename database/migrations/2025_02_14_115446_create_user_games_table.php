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
        Schema::create('user_games', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('game_id')->constrained('game_kenno');
            $table->integer('money');
            $table->json('choose');
            $table->enum('status', ['pending', 'success', 'error'])->default('pending')->comment('pending: đang chờ, success: đã trả thưởng thành công, error: thất bại');
            $table->enum('result', ['win', 'lose'])->nullable()->comment('win: thắng, lose: thua');
            $table->float('total_money');
            $table->float('total_win');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_games');
    }
};
