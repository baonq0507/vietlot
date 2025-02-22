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
        Schema::create('setting_xosos', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['xoso3p', 'xoso5p', 'xsmb', 'xsmn', 'xsmt', 'de_dac_biet']);
            $table->float('lo_thuong');
            $table->float('ba_cang');
            $table->float('db');
            $table->float('lo_xien_2');
            $table->float('lo_xien_3');
            $table->float('lo_xien_4');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('setting_xosos');
    }
};
