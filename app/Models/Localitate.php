<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Localitate extends Model
{
    use HasFactory, HasTranslations;

    protected $table = 'localitati';

    protected $guarded = ['id'];

    /** @var array<int, string> */
    public array $translatable = ['intro'];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
            'ordine' => 'integer',
        ];
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
