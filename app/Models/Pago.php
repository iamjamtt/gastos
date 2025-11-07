<?php

namespace App\Models;

use App\Traits\BootUserById;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pago extends Model
{
    use SoftDeletes;
    use BootUserById;

    const CREATED_AT = 'creado_en';
    const UPDATED_AT = 'actualizado_en';
    const DELETED_AT = 'eliminado_en';

    protected $table = 'tbl_pago';
    protected $primaryKey = 'id_pag';
    protected $fillable = [
        'id_con',
        'id_inq',
        'fecha_pago_pag',
        'medio_pag',
        'monto_total_pag',
        'creado_en',
        'actualizado_en',
        'eliminado_en',
        'creado_por',
        'actualizado_por',
        'eliminado_por',
    ];

    protected $casts = [
        'fecha_pago_pag' => 'date',
        'monto_total_pag' => 'decimal:2',
        'creado_en' => 'datetime',
        'actualizado_en' => 'datetime',
        'eliminado_en' => 'datetime',
    ];

    public function controlMensual()
    {
        return $this->belongsTo(ControlMensual::class, 'id_con', 'id_con');
    }

    public function inquilino()
    {
        return $this->belongsTo(Inquilino::class, 'id_inq', 'id_inq');
    }
}
