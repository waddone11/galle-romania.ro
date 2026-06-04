<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Recenzie reala de client — adaugata manual din admin, publicata explicit.
 * Textul ramane in limba originala a clientului (NU este traductibil).
 */
class Recenzie extends Model
{
    use HasFactory;

    /** Contextul recenziei: slug-urile paginilor de serviciu + lemn de foc + general. */
    public const SERVICII = [
        'lemn-de-foc' => 'Lemn de foc',
        'exploatare-forestiera' => 'Exploatare forestiera',
        'achizitie-masa-lemnoasa' => 'Achizitie masa lemnoasa',
        'curatare-terenuri' => 'Curatare terenuri',
        'transport-lemn' => 'Transport lemn',
        'lucrari-silvice' => 'Lucrari silvice',
        'general' => 'General',
    ];

    protected $table = 'recenzii';

    protected $guarded = ['id'];

    protected function casts(): array
    {
        return [
            'rating' => 'integer',
            'data' => 'date',
            'is_published' => 'boolean',
            'ordine' => 'integer',
        ];
    }

    /** Initialele clientului pentru avatarul fara poza (ex. "Ion Pop" -> "IP"). */
    public function initiale(): string
    {
        return collect(explode(' ', trim($this->nume_client)))
            ->filter()
            ->take(2)
            ->map(fn (string $parte) => mb_strtoupper(mb_substr($parte, 0, 1)))
            ->implode('');
    }
}
