<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Translatable\HasTranslations;

class Proiect extends Model implements HasMedia
{
    use HasFactory, HasTranslations, InteractsWithMedia;

    protected $table = 'proiecte';

    protected $guarded = ['id'];

    /** @var array<int, string> */
    public array $translatable = ['titlu', 'descriere', 'continut'];

    protected function casts(): array
    {
        return [
            'an'           => 'integer',
            'is_published' => 'boolean',
            'ordine'       => 'integer',
        ];
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('galerie');
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
