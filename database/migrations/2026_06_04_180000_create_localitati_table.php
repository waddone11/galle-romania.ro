<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('localitati', function (Blueprint $table) {
            $table->id();
            $table->string('nume', 120);
            $table->string('slug', 140)->unique();
            $table->string('judet', 60);
            $table->json('intro')->nullable();   // translatable
            $table->boolean('is_active')->default(true);
            $table->unsignedInteger('ordine')->default(0);
            $table->timestamps();

            $table->index(['is_active', 'ordine']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('localitati');
    }
};
