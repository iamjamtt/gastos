<?php

namespace App\Enums;

enum MedioPagoEnum: string
{
    case EFECTIVO = 'efectivo';
    case YAPE = 'yape';
    case OTRO = 'otro';

    public function label(): string
    {
        return match ($this) {
            self::EFECTIVO => 'Efectivo',
            self::YAPE => 'Yape',
            self::OTRO => 'Otro',
        };
    }
}
