<?php

namespace App\Enums;

enum ServicioBaseEnum: string
{
    case LUZ = 'luz';
    case AGUA = 'agua';
    case NINGUNO = 'ninguno';

    public function label(): string
    {
        return match ($this) {
            self::LUZ => 'Luz',
            self::AGUA => 'Agua',
            self::NINGUNO => 'Ninguno',
        };
    }

    public function color(): string
    {
        return match ($this) {
            self::LUZ => 'yellow',
            self::AGUA => 'blue',
            self::NINGUNO => 'zinc',
        };
    }
}
