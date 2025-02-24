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
        Schema::table('game_kenno', function (Blueprint $table) {
            $table->enum('type', ['kenno1p', 'kenno3p', 'kenno5p', 'xucxac3p', 'xucxac5p', 'xoso3p', 'xoso5p', 'xsmn', 'xsmt', 'xsmb'])
                ->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('game_kenno', function (Blueprint $table) {
            $table->string('type')->change();
        });
    }
};
