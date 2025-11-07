<?php

namespace App\Enums;

enum MetodoEnum: string
{
    case PROPORCIONAL_CONSUMO = 'proporcional_consumo';
    case PRORRATEO_SIMPLES = 'prorrateo_simple';
    case MONTO_FIJO = 'monto_fijo';

    public function label(): string
    {
        return match ($this) {
            self::PROPORCIONAL_CONSUMO => 'Proporcional por Consumo',
            self::PRORRATEO_SIMPLES => 'Prorrateo Simple',
            self::MONTO_FIJO => 'Monto Fijo',
        };
    }
}
