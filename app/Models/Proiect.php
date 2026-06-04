<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Image\Enums\Fit;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
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
            'an' => 'integer',
            'is_published' => 'boolean',
            'ordine' => 'integer',
        ];
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('galerie');
    }

    public function registerMediaConversions(?Media $media = null): void
    {
        // card: cover 16:9 in listari/teasere; mare: varianta lightbox/galerie.
        $this->addMediaConversion('card')->nonQueued()->fit(Fit::Crop, 800, 450);
        $this->addMediaConversion('mare')->nonQueued()->fit(Fit::Max, 1600, 1200);
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
