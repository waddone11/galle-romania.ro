<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('traduceri', function (Blueprint $table) {
            $table->id();
            $table->string('cheie')->unique();           // textul RO folosit ca cheie in __()
            $table->string('grup')->default('general')->index(); // nav / footer / forms / blocks / cookies / general
            $table->json('valoare');                     // translatable {ro, de, en}
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('traduceri');
    }
};
