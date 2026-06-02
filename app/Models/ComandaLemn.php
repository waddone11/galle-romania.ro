<?php

namespace App\Models;

use App\Enums\ComandaStatus;
use App\Enums\SpecieUnitate;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ComandaLemn extends Model
{
    use HasFactory;

    protected $table = 'comenzi_lemn';

    protected $guarded = ['id'];

    protected function casts(): array
    {
        return [
            'status'      => ComandaStatus::class,
            'unitate'     => SpecieUnitate::class,
            'cantitate'   => 'decimal:2',
            'data_dorita' => 'date',
        ];
    }

    public function specie(): BelongsTo
    {
        return $this->belongsTo(Specie::class);
    }
}
