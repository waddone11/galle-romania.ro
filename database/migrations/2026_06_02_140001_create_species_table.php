<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('species', function (Blueprint $table) {
            $table->id();
            $table->json('nume');                       // translatable: ro/de/en
            $table->string('slug')->unique();
            $table->string('status', 20)->default('in_curand');
            $table->json('descriere')->nullable();      // translatable
            $table->decimal('pret_pornire', 10, 2)->nullable();
            $table->string('unitate', 10)->default('ster');
            $table->decimal('pret_per_unitate', 10, 2)->nullable();
            $table->decimal('putere_calorica', 6, 2)->nullable(); // kWh/kg
            $table->string('imagine')->nullable();
            $table->boolean('is_active')->default(true);
            $table->unsignedInteger('ordine')->default(0);
            $table->timestamps();

            $table->index(['is_active', 'ordine']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('species');
    }
};
