<?php

namespace App\Enums;

enum SpecieStatus: string
{
    case Disponibil = 'disponibil';
    case InCurand   = 'in_curand';

    public function label(): string
    {
        return match ($this) {
            self::Disponibil => 'Disponibil',
            self::InCurand   => 'In curand',
        };
    }

    public function color(): string
    {
        return match ($this) {
            self::Disponibil => 'success',
            self::InCurand   => 'warning',
        };
    }
}
