<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pagini', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->json('titlu');
            $table->json('meta_title')->nullable();
            $table->json('meta_description')->nullable();
            $table->string('og_image')->nullable();
            $table->json('sectiuni')->nullable();   // Filament Builder: hero / text+image / splitter / carduri / CTA / galerie / faq-embed
            $table->boolean('is_published')->default(false);
            $table->unsignedInteger('ordine')->default(0);
            $table->timestamps();

            $table->index(['is_published', 'ordine']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pagini');
    }
};
