<?php

namespace App\Enums;

enum TipoEnum: string
{
    case PRINCIPAL = 'principal';
    case INQUILINO = 'inquilino';

    public function label(): string
    {
        return match ($this) {
            self::PRINCIPAL => 'Principal',
            self::INQUILINO => 'Inquilino',
        };
    }
}
