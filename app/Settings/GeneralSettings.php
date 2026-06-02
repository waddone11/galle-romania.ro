<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class GeneralSettings extends Settings
{
    public string $telefon = '+40 700 000 000';

    public string $whatsapp = '40700000000';

    public string $email = 'contact@galle-silva.ro';

    public string $adresa = 'Romania';

    public string $program = 'Luni - Vineri, 09:00 - 18:00';

    /**
     * JSON-encoded social handles map { facebook, instagram, linkedin, youtube }.
     * Stored as string to avoid spatie/laravel-settings array-cast inference
     * which expects an element-level SettingsCast for typed array properties.
     */
    public string $social_json = '{"facebook":null,"instagram":null,"linkedin":null,"youtube":null}';

    /** JSON-encoded preturi globale map { tva: int }. Same rationale as $social_json. */
    public string $preturi_globale_json = '{"tva":19}';

    public static function group(): string
    {
        return 'general';
    }

    /** @return array<string, string|null> */
    public function social(): array
    {
        return json_decode($this->social_json, true) ?: [];
    }

    /** @return array<string, mixed> */
    public function preturiGlobale(): array
    {
        return json_decode($this->preturi_globale_json, true) ?: [];
    }
}
