<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Pagina extends Model
{
    use HasFactory, HasTranslations;

    protected $table = 'pagini';

    protected $guarded = ['id'];

    /**
     * @var array<int, string>
     *
     * Note: `sectiuni` is NOT translatable — it holds Filament Builder block data
     * where individual text fields within each block are translatable JSON themselves.
     */
    public array $translatable = ['titlu', 'meta_title', 'meta_description'];

    protected function casts(): array
    {
        return [
            'sectiuni' => 'array',
            'is_published' => 'boolean',
            'ordine' => 'integer',
        ];
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
