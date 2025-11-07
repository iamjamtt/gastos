<?php

namespace App\Enums;

enum EstadoControlEnum: string
{
    case BORRADOR = 'borrador';
    case CALCULADO = 'calculado';
    case CERRADO = 'cerrado';

    public function label(): string
    {
        return match ($this) {
            self::BORRADOR => 'Borrador',
            self::CALCULADO => 'Calculado',
            self::CERRADO => 'Cerrado',
        };
    }

    public function color(): string
    {
        return match ($this) {
            self::BORRADOR => 'yellow',
            self::CALCULADO => 'blue',
            self::CERRADO => 'zinc',
        };
    }
}
