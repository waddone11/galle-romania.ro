<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('recenzii', function (Blueprint $table) {
            $table->id();
            $table->string('nume_client');
            $table->string('localitate')->nullable();
            $table->unsignedTinyInteger('rating')->nullable(); // 1–5
            $table->text('text'); // limba originala a clientului — NU se traduce
            $table->string('serviciu', 60)->nullable(); // context: lemn-de-foc, exploatare-forestiera...
            $table->date('data')->nullable();
            $table->string('sursa', 60)->nullable(); // Google, WhatsApp, direct...
            $table->string('imagine')->nullable(); // avatar optional; fallback pe initiale
            $table->boolean('is_published')->default(false); // publicare explicita din admin
            $table->unsignedInteger('ordine')->default(0);
            $table->timestamps();

            $table->index(['is_published', 'serviciu', 'ordine']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('recenzii');
    }
};
