<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Proiect extends Model
{
    use HasFactory, HasTranslations;

    protected $table = 'proiecte';

    protected $guarded = ['id'];

    /** @var array<int, string> */
    public array $translatable = ['titlu', 'descriere', 'continut'];

    protected function casts(): array
    {
        return [
            'an' => 'integer',
            'is_published' => 'boolean',
            'ordine' => 'integer',
            // Cai statice sub public/images (ex. "galle/proiecte/x.webp") —
            // servite cu asset(), fara Media Library / symlink storage.
            'galerie' => 'array',
        ];
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    /**
     * URL-urile absolute ale galeriei. Accepta cai cu sau fara prefixul
     * "images/" (seederele il omit; upload-urile Filament pe disk-ul
     * public_images il omit de asemenea).
     *
     * @return list<string>
     */
    public function galerieUrls(): array
    {
        $urls = [];

        foreach ((array) ($this->galerie ?? []) as $cale) {
            $cale = (string) $cale;

            if ($cale !== '') {
                $urls[] = asset(str_starts_with($cale, 'images/') ? $cale : 'images/'.$cale);
            }
        }

        return $urls;
    }

    /** Cover-ul (prima imagine din galerie) sau null. */
    public function coverUrl(): ?string
    {
        return $this->galerieUrls()[0] ?? null;
    }
}
