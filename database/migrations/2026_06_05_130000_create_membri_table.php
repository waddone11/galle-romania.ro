<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('membri', function (Blueprint $table) {
            $table->id();
            $table->string('nume'); // numele propriu — NU se traduce
            $table->json('rol'); // translatable: ro/de/en
            $table->string('imagine')->nullable(); // foto optionala; fallback pe initiale
            $table->boolean('is_active')->default(true);
            $table->unsignedInteger('ordine')->default(0);
            $table->timestamps();

            $table->index(['is_active', 'ordine']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('membri');
    }
};
