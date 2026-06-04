<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Spatie\Translatable\HasTranslations;

class Traducere extends Model
{
    use HasTranslations;

    protected $table = 'traduceri';

    protected $fillable = ['cheie', 'grup', 'valoare'];

    /** @var array<int, string> */
    public array $translatable = ['valoare'];

    protected static function booted(): void
    {
        $bust = function (): void {
            foreach (['ro', 'de', 'en'] as $loc) {
                Cache::forget("traduceri.$loc");
            }
        };

        static::saved($bust);
        static::deleted($bust);
    }
}
