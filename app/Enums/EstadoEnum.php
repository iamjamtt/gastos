<?php

namespace App\Enums;

enum EstadoEnum: string
{
    case HABILITADO = 'habilitado';
    case DESHABILITADO = 'deshabilitado';

    public function label(): string
    {
        return match ($this) {
            self::HABILITADO => 'Habilitado',
            self::DESHABILITADO => 'Deshabilitado',
        };
    }

    public function color(): string
    {
        return match ($this) {
            self::HABILITADO => 'green',
            self::DESHABILITADO => 'red',
        };
    }
}
