<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('certificari', function (Blueprint $table) {
            $table->id();
            $table->string('nume');
            $table->string('tip', 30); // FSC | PEFC | ISO9001 | ISO14001 | RAL | DEKRA
            $table->string('status', 20)->default('in_proces');
            $table->string('numar')->nullable();
            $table->date('data_emitere')->nullable();
            $table->string('emitent')->nullable();
            $table->json('descriere')->nullable();
            $table->boolean('is_active')->default(true);
            $table->unsignedInteger('ordine')->default(0);
            $table->timestamps();

            $table->index(['tip', 'is_active']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('certificari');
    }
};
