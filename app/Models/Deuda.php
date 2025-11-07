<?php

namespace App\Models;

use App\Enums\OrigenEnum;
use App\Traits\BootUserById;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Deuda extends Model
{
    use SoftDeletes;
    use BootUserById;

    const CREATED_AT = 'creado_en';
    const UPDATED_AT = 'actualizado_en';
    const DELETED_AT = 'eliminado_en';

    protected $table = 'tbl_deuda';
    protected $primaryKey = 'id_deu';
    protected $fillable = [
        'id_con',
        'id_inq',
        'id_cat',
        'descripcion_deu',
        'origen_deu',
        'monto_total_deu',
        'saldo_deu',
        'creado_en',
        'actualizado_en',
        'eliminado_en',
        'creado_por',
        'actualizado_por',
        'eliminado_por',
    ];

    protected $casts = [
        'origen_deu' => OrigenEnum::class,
        'monto_total_deu' => 'decimal:2',
        'saldo_deu' => 'decimal:2',
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

    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'id_cat', 'id_cat');
    }
}
