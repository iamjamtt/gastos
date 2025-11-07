<?php

namespace App\Enums;

enum OrigenEnum: string
{
    case AUTO = 'auto';
    case MANUAL = 'manual';

    public function label(): string
    {
        return match ($this) {
            self::AUTO => 'Automático',
            self::MANUAL => 'Manual',
        };
    }
}
