<?php

namespace App\Enums;

enum ServicioEnum: string
{
    case AGUA = 'agua';
    case LUZ = 'luz';
    case OTRO = 'otro';

    public function label(): string
    {
        return match ($this) {
            self::AGUA => 'Agua',
            self::LUZ => 'Luz',
            self::OTRO => 'Otro',
        };
    }
}
