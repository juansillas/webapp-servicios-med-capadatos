<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TurnoActual extends Model
{
    protected $table = 'turnos_actuales';

    protected $fillable = [
        'personal_medico_id', 'fecha_inicio', 'fecha_fin'
    ];

    public function personalMedico()
    {
        return $this->belongsTo(PersonalMedico::class, 'personal_medico_id');
    }
}
