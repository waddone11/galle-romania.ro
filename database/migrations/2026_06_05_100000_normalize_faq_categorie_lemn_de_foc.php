<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

/**
 * Normalizare categorii FAQ: toate kebab-case.
 * Singura exceptie istorica era `lemn_de_foc` (underscore).
 */
return new class extends Migration
{
    public function up(): void
    {
        DB::table('faqs')->where('categorie', 'lemn_de_foc')->update(['categorie' => 'lemn-de-foc']);
    }

    public function down(): void
    {
        DB::table('faqs')->where('categorie', 'lemn-de-foc')->update(['categorie' => 'lemn_de_foc']);
    }
};
