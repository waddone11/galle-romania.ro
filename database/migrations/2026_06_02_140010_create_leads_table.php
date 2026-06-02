<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('leads', function (Blueprint $table) {
            $table->id();
            $table->string('nume');
            $table->string('firma')->nullable();
            $table->string('email');
            $table->string('telefon', 30)->nullable();
            $table->string('serviciu', 80)->nullable();
            $table->text('mesaj')->nullable();
            $table->string('status', 20)->default('nou');
            $table->string('source', 60)->nullable();
            $table->timestamps();

            $table->index(['status', 'created_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('leads');
    }
};
