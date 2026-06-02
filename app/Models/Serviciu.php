<?php

namespace App\Models;

use App\Enums\ServiciuAudienta;
use App\Enums\ServiciuCategorie;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Translatable\HasTranslations;

class Serviciu extends Model implements HasMedia
{
    use HasFactory, HasTranslations, InteractsWithMedia;

    protected $table = 'servicii';

    protected $guarded = ['id'];

    /** @var array<int, string> */
    public array $translatable = ['titlu', 'descriere', 'continut'];

    protected function casts(): array
    {
        return [
            'categorie' => ServiciuCategorie::class,
            'audienta' => ServiciuAudienta::class,
            'is_active' => 'boolean',
            'ordine' => 'integer',
        ];
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('imagini')->singleFile();
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
