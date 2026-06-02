<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('faqs', function (Blueprint $table) {
            $table->id();
            $table->json('intrebare');
            $table->json('raspuns');
            $table->string('categorie', 60)->nullable(); // ex: 'lemn_de_foc', 'livrare', 'plata'
            $table->unsignedInteger('ordine')->default(0);
            $table->boolean('is_published')->default(true);
            $table->timestamps();

            $table->index(['is_published', 'categorie', 'ordine']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('faqs');
    }
};
