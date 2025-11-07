<?php

namespace App\Models;

use App\Enums\ServicioEnum;
use App\Enums\TipoEnum;
use App\Traits\BootUserById;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Medidor extends Model
{
    use SoftDeletes;
    use BootUserById;

    const CREATED_AT = 'creado_en';
    const UPDATED_AT = 'actualizado_en';
    const DELETED_AT = 'eliminado_en';

    protected $table = 'tbl_medidor';
    protected $primaryKey = 'id_med';
    protected $fillable = [
        'servicio_med',
        'tipo_med',
        'id_inq',
        'etiqueta_med',
        'creado_en',
        'actualizado_en',
        'eliminado_en',
        'creado_por',
        'actualizado_por',
        'eliminado_por',
    ];

    protected $casts = [
        'servicio_med' => ServicioEnum::class,
        'tipo_med' => TipoEnum::class,
        'creado_en' => 'datetime',
        'actualizado_en' => 'datetime',
        'eliminado_en' => 'datetime',
    ];

    public function inquilino()
    {
        return $this->belongsTo(Inquilino::class, 'id_inq', 'id_inq');
    }
}
