<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Galeria proiectului = lista de cai statice sub public/images
     * (ex. "galle/proiecte/forwarder-drum.webp"), servite cu asset() —
     * fara Media Library / symlink storage (prod fara SSH nu il poate crea).
     */
    public function up(): void
    {
        Schema::table('proiecte', function (Blueprint $table) {
            $table->json('galerie')->nullable()->after('categorie');
        });
    }

    public function down(): void
    {
        Schema::table('proiecte', function (Blueprint $table) {
            $table->dropColumn('galerie');
        });
    }
};
