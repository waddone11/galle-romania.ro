<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('proiecte', function (Blueprint $table) {
            $table->id();
            $table->json('titlu');
            $table->string('slug')->unique();
            $table->json('descriere')->nullable();
            $table->json('continut')->nullable();
            $table->string('locatie')->nullable();
            $table->unsignedSmallInteger('an')->nullable();
            $table->string('categorie', 60)->nullable();
            $table->boolean('is_published')->default(false);
            $table->unsignedInteger('ordine')->default(0);
            $table->timestamps();

            $table->index(['is_published', 'ordine']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('proiecte');
    }
};
