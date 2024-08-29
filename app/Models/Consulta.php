<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Consulta extends Model
{
    protected $table = 'consultas';

    protected $fillable = [
        'paciente_id', 'personal_medico_id', 'fecha', 'diagnostico', 'tratamiento', 'quirofano_id'
    ];

    public function paciente()
    {
        return $this->belongsTo(Paciente::class, 'paciente_id');
    }

    public function personalMedico()
    {
        return $this->belongsTo(PersonalMedico::class, 'personal_medico_id');
    }

    public function quirofano()
    {
        return $this->belongsTo(Quirofano::class, 'quirofano_id');
    }
}

