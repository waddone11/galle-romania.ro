<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Cheile UI sunt propozitii intregi din Blade-uri — unele depasesc 255
     * de caractere. 500 ramane indexabil unic pe utf8mb4 (2000 < 3072 bytes).
     */
    public function up(): void
    {
        Schema::table('traduceri', function (Blueprint $table) {
            $table->string('cheie', 500)->change();
        });
    }

    public function down(): void
    {
        Schema::table('traduceri', function (Blueprint $table) {
            $table->string('cheie', 255)->change();
        });
    }
};
