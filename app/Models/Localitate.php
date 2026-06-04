<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Localitate extends Model
{
    use HasFactory, HasTranslations;

    protected $table = 'localitati';

    protected $guarded = ['id'];

    /** @var array<int, string> */
    public array $translatable = ['intro'];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
            'ordine' => 'integer',
        ];
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    /**
     * Numele localitatii pentru locale-ul dat. Localitatile raman netraduse
     * (nume proprii), dar Bucurestiul are exonime consacrate: Bukarest/Bucharest.
     */
    public function numeLocalizat(?string $locale = null): string
    {
        return self::exonim($this->nume, $locale ?? app()->getLocale());
    }

    /** Exonimul unui toponim (folosit si pentru judet). */
    public static function exonim(string $nume, string $locale): string
    {
        if ($nume === 'București') {
            return match ($locale) {
                'de' => 'Bukarest',
                'en' => 'Bucharest',
                default => $nume,
            };
        }

        return $nume;
    }
}
