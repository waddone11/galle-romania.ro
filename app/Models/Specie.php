<?php

namespace App\Models;

use App\Enums\SpecieStatus;
use App\Enums\SpecieUnitate;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Translatable\HasTranslations;

class Specie extends Model implements HasMedia
{
    use HasFactory, HasTranslations, InteractsWithMedia;

    protected $table = 'species';

    protected $guarded = ['id'];

    /** @var array<int, string> */
    public array $translatable = ['nume', 'descriere'];

    protected function casts(): array
    {
        return [
            'status' => SpecieStatus::class,
            'unitate' => SpecieUnitate::class,
            'pret_pornire' => 'decimal:2',
            'pret_per_unitate' => 'decimal:2',
            'putere_calorica' => 'decimal:2',
            'is_active' => 'boolean',
            'ordine' => 'integer',
        ];
    }

    public function comenzi(): HasMany
    {
        return $this->hasMany(ComandaLemn::class, 'specie_id');
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
