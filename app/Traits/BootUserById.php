<?php

namespace App\Traits;

use Illuminate\Support\Facades\Auth;

trait BootUserById
{
    protected static function boot()
    {
        parent::boot();
        static::bootAuditoria();

        static::creating(function ($modelo) {
            $modelo->creado_por = Auth::id();
        });
        static::updating(function ($modelo) {
            $modelo->actualizado_por = Auth::id();
        });
        static::deleting(function ($modelo) {
            $modelo->eliminado_por = Auth::id();
            $modelo->save();
        });
    }
}
