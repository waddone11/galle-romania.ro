<?php

namespace App\Enums;

enum ServiciuCategorie: string
{
    case Forestier = 'forestier';
    case Peisagistica = 'peisagistica';
    case Compostare = 'compostare';

    public function label(): string
    {
        return match ($this) {
            self::Forestier => 'Servicii forestiere',
            self::Peisagistica => 'Peisagistica',
            self::Compostare => 'Compostare',
        };
    }
}
