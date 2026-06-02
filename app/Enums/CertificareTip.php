<?php

namespace App\Enums;

enum CertificareTip: string
{
    case Fsc = 'FSC';
    case Pefc = 'PEFC';
    case Iso9001 = 'ISO9001';
    case Iso14001 = 'ISO14001';
    case Ral = 'RAL';
    case Dekra = 'DEKRA';

    public function label(): string
    {
        return match ($this) {
            self::Fsc => 'FSC (lant de custodie)',
            self::Pefc => 'PEFC (lant de custodie)',
            self::Iso9001 => 'ISO 9001 (calitate)',
            self::Iso14001 => 'ISO 14001 (mediu)',
            self::Ral => 'RAL (calitate Germania)',
            self::Dekra => 'DEKRA (certificare independenta)',
        };
    }
}
