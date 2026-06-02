<?php

namespace App\Enums;

enum CertificareStatus: string
{
    case InProces = 'in_proces';
    case Activ    = 'activ';

    public function label(): string
    {
        return match ($this) {
            self::InProces => 'In proces de certificare',
            self::Activ    => 'Activ',
        };
    }

    public function color(): string
    {
        return match ($this) {
            self::InProces => 'warning',
            self::Activ    => 'success',
        };
    }
}
