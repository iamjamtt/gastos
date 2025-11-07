<?php

namespace App\Models;

use App\Traits\BootUserById;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PagoDetalle extends Model
{
    use SoftDeletes;
    use BootUserById;

    const CREATED_AT = 'creado_en';
    const UPDATED_AT = 'actualizado_en';
    const DELETED_AT = 'eliminado_en';

    protected $table = 'tbl_pago_detalle';
    protected $primaryKey = 'id_pde';
    protected $fillable = [
        'id_pag',
        'id_deu',
        'monto_aplicado_pde',
        'creado_en',
        'actualizado_en',
        'eliminado_en',
        'creado_por',
        'actualizado_por',
        'eliminado_por',
    ];

    protected $casts = [
        'monto_aplicado_pde' => 'decimal:2',
        'creado_en' => 'datetime',
        'actualizado_en' => 'datetime',
        'eliminado_en' => 'datetime',
    ];

    public function pago()
    {
        return $this->belongsTo(Pago::class, 'id_pag', 'id_pag');
    }

    public function deuda()
    {
        return $this->belongsTo(Deuda::class, 'id_deu', 'id_deu');
    }
}
