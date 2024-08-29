<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PersonalMedico extends Model
{
    protected $table = 'personal_medico';

    protected $fillable = [
        'nombre', 'especialidad', 'horario', 'turno_actual_id'
    ];

    public function turnos()
    {
        return $this->hasMany(TurnoActual::class, 'personal_medico_id');
    }

    public function consultas()
    {
        return $this->hasMany(Consulta::class, 'personal_medico_id');
    }
}

