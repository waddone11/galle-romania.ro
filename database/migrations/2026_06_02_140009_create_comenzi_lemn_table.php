<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('comenzi_lemn', function (Blueprint $table) {
            $table->id();
            $table->string('nume');
            $table->string('telefon', 30);
            $table->string('email')->nullable();
            $table->string('localitate');
            $table->foreignId('specie_id')->nullable()->constrained('species')->nullOnDelete();
            $table->decimal('cantitate', 10, 2);
            $table->string('unitate', 10);
            $table->date('data_dorita')->nullable();
            $table->text('mesaj')->nullable();
            $table->string('status', 20)->default('nou');
            $table->string('source', 60)->nullable();  // 'calculator', 'form', 'whatsapp', etc.
            $table->timestamps();

            $table->index(['status', 'created_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('comenzi_lemn');
    }
};
