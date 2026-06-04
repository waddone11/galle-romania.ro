<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;

class TraducereSeeder extends Seeder
{
    /**
     * Populeaza cheile UI scanand Blade-urile — idempotent, nu suprascrie
     * traducerile DE/EN deja completate din admin.
     */
    public function run(): void
    {
        Artisan::call('traduceri:extract');
    }
}
