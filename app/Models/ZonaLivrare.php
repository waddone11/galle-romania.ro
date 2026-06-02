<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class ZonaLivrare extends Model
{
    use HasFactory, HasTranslations;

    protected $table = 'zone_livrare';

    protected $guarded = ['id'];

    /** @var array<int, string> */
    public array $translatable = ['nota'];

    protected function casts(): array
    {
        return [
            'localitati'   => 'array',
            'cost_livrare' => 'decimal:2',
            'is_active'    => 'boolean',
            'ordine'       => 'integer',
        ];
    }
}
