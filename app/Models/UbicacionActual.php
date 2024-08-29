<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UbicacionActual extends Model
{
    protected $table = 'ubicaciones_actuales';

    protected $fillable = [
        'paciente_id', 'tipo_ubicacion', 'detalles_ubicacion', 'cama_id'
    ];

    public function paciente()
    {
        return $this->belongsTo(Paciente::class, 'paciente_id');
    }

    public function cama()
    {
        return $this->belongsTo(Cama::class, 'cama_id');
    }
}

