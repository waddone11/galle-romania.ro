<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Faq extends Model
{
    use HasFactory, HasTranslations;

    protected $guarded = ['id'];

    /** @var array<int, string> */
    public array $translatable = ['intrebare', 'raspuns'];

    protected function casts(): array
    {
        return [
            'is_published' => 'boolean',
            'ordine' => 'integer',
        ];
    }
}
