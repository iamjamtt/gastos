<?php

namespace App\Models;

use App\Enums\MetodoEnum;
use App\Enums\ServicioBaseEnum;
use App\Traits\BootUserById;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Categoria extends Model
{
    use SoftDeletes;
    use BootUserById;

    const CREATED_AT = 'creado_en';
    const UPDATED_AT = 'actualizado_en';
    const DELETED_AT = 'eliminado_en';

    protected $table = 'tbl_categoria';
    protected $primaryKey = 'id_cat';
    protected $fillable = [
        'id_con',
        'nombre_cat',
        'metodo_cat',
        'servicio_base_cat',
        'creado_en',
        'actualizado_en',
        'eliminado_en',
        'creado_por',
        'actualizado_por',
        'eliminado_por',
    ];

    protected $casts = [
        'metodo_cat' => MetodoEnum::class,
        'servicio_base_cat' => ServicioBaseEnum::class,
        'creado_en' => 'datetime',
        'actualizado_en' => 'datetime',
        'eliminado_en' => 'datetime',
    ];
}
