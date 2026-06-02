<?php

namespace App\Enums;

enum ServiciuAudienta: string
{
    case Privat = 'privat';
    case Institutie = 'institutie';
    case Ambele = 'ambele';

    public function label(): string
    {
        return match ($this) {
            self::Privat => 'Client privat',
            self::Institutie => 'Firma / institutie',
            self::Ambele => 'Ambele',
        };
    }
}
