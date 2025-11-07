<?php

namespace App\Models;

use App\Traits\BootUserById;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ControlInquilino extends Model
{
    use SoftDeletes;
    use BootUserById;

    const CREATED_AT = 'creado_en';
    const UPDATED_AT = 'actualizado_en';
    const DELETED_AT = 'eliminado_en';

    protected $table = 'tbl_control_inquilino';
    protected $primaryKey = 'id_cin';
    protected $fillable = [
        'id_con',
        'id_inq',
        'creado_en',
        'actualizado_en',
        'eliminado_en',
        'creado_por',
        'actualizado_por',
        'eliminado_por',
    ];

    protected $casts = [
        'creado_en' => 'datetime',
        'actualizado_en' => 'datetime',
        'eliminado_en' => 'datetime',
    ];

    public function inquilino()
    {
        return $this->belongsTo(Inquilino::class, 'id_inq', 'id_inq');
    }

    public function controlMensual()
    {
        return $this->belongsTo(ControlMensual::class, 'id_con', 'id_con');
    }
}
