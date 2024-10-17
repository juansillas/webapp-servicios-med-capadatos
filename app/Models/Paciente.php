<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paciente extends Model
{
    use HasFactory;

    protected $table = 'pacientes';

    protected $fillable = [
        'nombre',
        'apellido',
        'fecha_nacimiento',
        'estado',
        'historial_medico_id',
        'ubicacion_actual_id'
    ];

    public function historialMedico()
    {
        return $this->hasOne(HistorialMedico::class, 'paciente_id');
    }

    public function ubicacionActual()
    {
        return $this->hasOne(UbicacionActual::class, 'paciente_id');
    }

    public function consultas()
    {
        return $this->hasMany(Consulta::class, 'paciente_id');
    }
}
