<?php

namespace App\Models;

use App\Enums\EstadoControlEnum;
use App\Traits\BootUserById;
use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ControlMensual extends Model
{
    use SoftDeletes;
    use BootUserById;

    const CREATED_AT = 'creado_en';
    const UPDATED_AT = 'actualizado_en';
    const DELETED_AT = 'eliminado_en';

    protected $table = 'tbl_control_mensual';
    protected $primaryKey = 'id_con';
    protected $fillable = [
        'anio_con',
        'mes_con',
        'titulo_con',
        'estado_con',
        'observacion_con',
        'creado_en',
        'actualizado_en',
        'eliminado_en',
        'creado_por',
        'actualizado_por',
        'eliminado_por',
    ];

    protected $casts = [
        'estado_con' => EstadoControlEnum::class,
        'creado_en' => 'datetime',
        'actualizado_en' => 'datetime',
        'eliminado_en' => 'datetime',
    ];

    public function controlInquilinos()
    {
        return $this->hasMany(ControlInquilino::class, 'id_con', 'id_con');
    }

    #[Scope]
    protected function search(Builder $query, string $buscar): void
    {
        $query->where(function (Builder $subQuery) use ($buscar) {
            $subQuery->where('titulo_con', 'like', "%{$buscar}%")
                ->orWhere('observacion_con', 'like', "%{$buscar}%");
        });
    }
}
