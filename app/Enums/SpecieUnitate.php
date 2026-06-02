<?php

namespace App\Enums;

enum SpecieUnitate: string
{
    case Ster = 'ster';
    case Tona = 'tona';

    public function label(): string
    {
        return match ($this) {
            self::Ster => 'Metru ster',
            self::Tona => 'Tona',
        };
    }
}
