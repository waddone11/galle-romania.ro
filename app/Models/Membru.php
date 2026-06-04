<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

/**
 * Membru al echipei Galle Silva — afisat in blocul CMS `echipa` de pe /despre.
 * Foto optionala (incarcata din admin); fallback pe avatar cu initiale.
 */
class Membru extends Model
{
    use HasFactory, HasTranslations;

    protected $table = 'membri';

    protected $guarded = ['id'];

    /** @var array<int, string> */
    public array $translatable = ['rol'];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
            'ordine' => 'integer',
        ];
    }

    /** Initialele membrului pentru avatarul fara poza (ex. "Ion Pop" -> "IP"). */
    public function initiale(): string
    {
        return collect(explode(' ', trim($this->nume)))
            ->filter()
            ->take(2)
            ->map(fn (string $parte) => mb_strtoupper(mb_substr($parte, 0, 1)))
            ->implode('');
    }
}
