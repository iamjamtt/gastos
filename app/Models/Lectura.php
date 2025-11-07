<?php

namespace App\Models;

use App\Traits\BootUserById;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Lectura extends Model
{
    use SoftDeletes;
    use BootUserById;

    const CREATED_AT = 'creado_en';
    const UPDATED_AT = 'actualizado_en';
    const DELETED_AT = 'eliminado_en';

    protected $table = 'tbl_lectura';
    protected $primaryKey = 'id_lec';
    protected $fillable = [
        'id_con',
        'id_med',
        'lectura_anterior_lec',
        'lectura_actual_lec',
        'consumo_lec',
        'fecha_lectura_lec',
        'creado_en',
        'actualizado_en',
        'eliminado_en',
        'creado_por',
        'actualizado_por',
        'eliminado_por',
    ];

    protected $casts = [
        'lectura_anterior_lec' => 'decimal:3',
        'lectura_actual_lec' => 'decimal:3',
        'consumo_lec' => 'decimal:3',
        'fecha_lectura_lec' => 'date',
        'creado_en' => 'datetime',
        'actualizado_en' => 'datetime',
        'eliminado_en' => 'datetime',
    ];
}
