<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('articole', function (Blueprint $table) {
            $table->id();
            $table->json('titlu');
            $table->string('slug')->unique();
            $table->json('excerpt')->nullable();
            $table->json('continut')->nullable();
            $table->string('imagine')->nullable();
            $table->string('categorie', 60)->nullable();
            $table->timestamp('published_at')->nullable();
            $table->boolean('is_published')->default(false);
            $table->timestamps();

            $table->index(['is_published', 'published_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('articole');
    }
};
