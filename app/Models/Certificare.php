<?php

namespace App\Models;

use App\Enums\CertificareStatus;
use App\Enums\CertificareTip;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Certificare extends Model
{
    use HasFactory, HasTranslations;

    protected $table = 'certificari';

    protected $guarded = ['id'];

    /** @var array<int, string> */
    public array $translatable = ['descriere'];

    protected function casts(): array
    {
        return [
            'tip'          => CertificareTip::class,
            'status'       => CertificareStatus::class,
            'data_emitere' => 'date',
            'is_active'    => 'boolean',
            'ordine'       => 'integer',
        ];
    }
}
