<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('zone_livrare', function (Blueprint $table) {
            $table->id();
            $table->string('judet', 60);
            $table->json('localitati')->nullable();    // ["Ploiesti", "Campina", ...]
            $table->decimal('cost_livrare', 10, 2)->default(0);
            $table->json('nota')->nullable();           // translatable
            $table->boolean('is_active')->default(true);
            $table->unsignedInteger('ordine')->default(0);
            $table->timestamps();

            $table->index(['is_active', 'ordine']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('zone_livrare');
    }
};
