<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Quirofano extends Model
{
    protected $table = 'quirofanos';

    protected $fillable = [
        'numero_quirofano', 'estado', 'disponibilidad', 'equipo_medico_id'
    ];

    public function consultas()
    {
        return $this->hasMany(Consulta::class, 'quirofano_id');
    }

    public function equipoMedico()
    {
        return $this->belongsTo(EquipoMedico::class, 'equipo_medico_id');
    }
}

