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

    /** @var array<int, string> */
    public array $translatable = ['titlu', 'meta_title', 'meta_description', 'sectiuni'];

    protected function casts(): array
    {
        return [
            'is_published' => 'boolean',
            'ordine'       => 'integer',
        ];
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
