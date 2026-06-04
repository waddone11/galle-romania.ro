<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Faq extends Model
{
    use HasFactory, HasTranslations;

    /**
     * Categoriile FAQ (slug kebab-case => eticheta RO).
     * Sursa unica pentru select-urile din Filament si pentru ordinea
     * grupurilor pe /intrebari-frecvente. Etichetele se afiseaza prin __().
     *
     * @var array<string, string>
     */
    public const CATEGORII = [
        'lemn-de-foc' => 'Lemn de foc',
        'livrare' => 'Livrare',
        'plata' => 'Plata',
        'exploatare-forestiera' => 'Exploatare forestiera',
        'achizitie-masa-lemnoasa' => 'Achizitie masa lemnoasa',
        'curatare-terenuri' => 'Curatare terenuri',
        'transport-lemn' => 'Transport lemn',
        'lucrari-silvice' => 'Lucrari silvice',
        'servicii' => 'Servicii',
        'general' => 'Intrebari generale',
    ];

    protected $guarded = ['id'];

    /** @var array<int, string> */
    public array $translatable = ['intrebare', 'raspuns'];

    protected function casts(): array
    {
        return [
            'is_published' => 'boolean',
            'ordine' => 'integer',
        ];
    }
}
