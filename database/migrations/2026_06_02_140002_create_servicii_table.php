<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('servicii', function (Blueprint $table) {
            $table->id();
            $table->json('titlu');
            $table->string('slug')->unique();
            $table->string('categorie', 30);  // forestier | peisagistica | compostare
            $table->string('audienta', 20)->default('ambele'); // privat | institutie | ambele
            $table->json('descriere')->nullable();
            $table->json('continut')->nullable();
            $table->string('imagine')->nullable();
            $table->boolean('is_active')->default(true);
            $table->unsignedInteger('ordine')->default(0);
            $table->timestamps();

            $table->index(['categorie', 'is_active']);
            $table->index(['audienta', 'is_active']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('servicii');
    }
};
