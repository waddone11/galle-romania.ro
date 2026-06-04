<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('certificari', function (Blueprint $table) {
            $table->string('slug')->nullable()->unique()->after('nume');
            $table->string('logo')->nullable()->after('slug');
            $table->string('detinator')->nullable()->after('emitent');
        });

        // Backfill slug + logo din tip pentru randurile existente,
        // ca seederul sa poata face upsert pe slug fara duplicate.
        $map = [
            'FSC' => ['fsc', '/images/certificari/fsc.svg'],
            'PEFC' => ['pefc', '/images/certificari/pefc.png'],
            'ISO9001' => ['iso-9001', '/images/certificari/iso-9001.svg'],
            'ISO14001' => ['iso-14001', '/images/certificari/iso-14001.svg'],
            'RAL' => ['ral', '/images/certificari/ral.svg'],
            'DEKRA' => ['dekra', '/images/certificari/dekra.svg'],
        ];

        foreach ($map as $tip => [$slug, $logo]) {
            DB::table('certificari')
                ->where('tip', $tip)
                ->whereNull('slug')
                ->orderBy('id')
                ->limit(1)
                ->update(['slug' => $slug, 'logo' => $logo]);
        }
    }

    public function down(): void
    {
        Schema::table('certificari', function (Blueprint $table) {
            $table->dropUnique(['slug']);
            $table->dropColumn(['slug', 'logo', 'detinator']);
        });
    }
};
