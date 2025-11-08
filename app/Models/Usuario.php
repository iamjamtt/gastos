<?php

namespace App\Models;

use App\Enums\EstadoEnum;
use App\Enums\RolEnum;
use App\Traits\BootUserById;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Usuario extends Authenticatable
{
    use SoftDeletes;
    use BootUserById;

    const CREATED_AT = 'creado_en';
    const UPDATED_AT = 'actualizado_en';
    const DELETED_AT = 'eliminado_en';

    protected $table = 'tbl_usuario';
    protected $primaryKey = 'id_usu';
    protected $fillable = [
        'nombre_usu',
        'usuario_usu',
        'password_usu',
        'rol_usu',
        'id_inq',
        'remember_token',
        'estado_usu',
        'creado_en',
        'actualizado_en',
        'eliminado_en',
        'creado_por',
        'actualizado_por',
        'eliminado_por',
    ];

    protected $casts = [
        'rol_usu' => RolEnum::class,
        'estado_usu' => EstadoEnum::class,
        'creado_en' => 'datetime',
        'actualizado_en' => 'datetime',
        'eliminado_en' => 'datetime',
    ];

    protected $hidden = [
        'password_usu',
        'remember_token',
    ];

    protected $appends = [
        'iniciales',
    ];

    public function inquilino()
    {
        return $this->belongsTo(Inquilino::class, 'id_inq', 'id_inq');
    }

    public function getInicialesAttribute()
    {
        $nombres = explode(' ', $this->nombre_usu);
        $iniciales = '';

        foreach ($nombres as $nombre) {
            $iniciales .= strtoupper(substr($nombre, 0, 1));
        }

        return $iniciales;
    }
}
