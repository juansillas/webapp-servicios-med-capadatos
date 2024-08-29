<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cama extends Model
{
    protected $table = 'camas';

    protected $fillable = [
        'numero_cama', 'ubicacion', 'estado'
    ];

    public function ubicacionActual()
    {
        return $this->hasOne(UbicacionActual::class, 'cama_id');
    }
}
