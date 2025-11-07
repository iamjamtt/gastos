<?php

namespace App\Enums;

enum RolEnum: string
{
    case ADMIN = 'admin';
    case INQUILINO = 'inquilino';

    public function label(): string
    {
        return match ($this) {
            self::ADMIN => 'Admin',
            self::INQUILINO => 'Inquilino',
        };
    }
}
