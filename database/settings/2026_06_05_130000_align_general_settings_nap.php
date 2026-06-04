<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

/*
 * Aliniaza NAP-ul din GeneralSettings cu datele reale din config/company.php.
 * Actualizeaza DOAR placeholder-ele initiale — valorile editate din admin raman.
 */
return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->update(
            'general.telefon',
            fn (string $v) => $v === '+40 700 000 000' ? config('company.telefon') : $v
        );
        $this->migrator->update(
            'general.whatsapp',
            fn (string $v) => $v === '40700000000' ? preg_replace('/\D/', '', (string) config('company.telefon')) : $v
        );
        $this->migrator->update(
            'general.email',
            fn (string $v) => $v === 'contact@galle-silva.ro' ? config('company.email') : $v
        );
        $this->migrator->update(
            'general.adresa',
            fn (string $v) => $v === 'Romania'
                ? sprintf('%s, %s, jud. %s', config('company.localitate'), config('company.adresa'), config('company.judet'))
                : $v
        );
    }
};
