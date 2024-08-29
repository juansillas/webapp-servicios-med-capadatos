<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EquipoMedico extends Model
{
    protected $table = 'equipos_medicos';

    protected $fillable = [
        'nombre_equipo', 'ubicacion', 'estado', 'fecha_mantenimiento'
    ];

    public function quirofano()
    {
        return $this->hasOne(Quirofano::class, 'equipo_medico_id');
    }
}

