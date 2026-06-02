<?php

namespace App\Enums;

/**
 * Shared status enum for ComandaLemn AND Lead — both follow the same
 * nou → contactat → finalizat / anulat lifecycle.
 */
enum ComandaStatus: string
{
    case Nou = 'nou';
    case Contactat = 'contactat';
    case Finalizat = 'finalizat';
    case Anulat = 'anulat';

    public function label(): string
    {
        return match ($this) {
            self::Nou => 'Nou',
            self::Contactat => 'Contactat',
            self::Finalizat => 'Finalizat',
            self::Anulat => 'Anulat',
        };
    }

    public function color(): string
    {
        return match ($this) {
            self::Nou => 'info',
            self::Contactat => 'warning',
            self::Finalizat => 'success',
            self::Anulat => 'gray',
        };
    }
}
