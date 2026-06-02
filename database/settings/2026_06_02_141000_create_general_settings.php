<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration {
    public function up(): void
    {
        $this->migrator->add('general.telefon', '+40 700 000 000');
        $this->migrator->add('general.whatsapp', '40700000000');
        $this->migrator->add('general.email', 'contact@galle-silva.ro');
        $this->migrator->add('general.adresa', 'Romania');
        $this->migrator->add('general.program', 'Luni - Vineri, 09:00 - 18:00');
        $this->migrator->add(
            'general.social_json',
            '{"facebook":null,"instagram":null,"linkedin":null,"youtube":null}'
        );
        $this->migrator->add('general.preturi_globale_json', '{"tva":19}');
    }
};
