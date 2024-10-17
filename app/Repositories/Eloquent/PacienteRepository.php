<?php

namespace App\Repositories\Eloquent;

use App\Models\Paciente;
use App\Repositories\Contracts\PacienteRepositoryInterface;

class PacienteRepository extends BaseRepository implements PacienteRepositoryInterface
{
    public function __construct(Paciente $model)
    {
        parent::__construct($model);
    }

    public function create(array $data)
    {
        return Paciente::create($data);
    }

    public function findByNombreApellido($nombre, $apellido)
    {
        return $this->model->where('nombre', $nombre)
                           ->where('apellido', $apellido)
                           ->first();
    }

    public function findByUbicacionActual($ubicacionActualId)
    {
        return $this->model->where('ubicacion_actual_id', $ubicacionActualId)->get();
    }

    public function getPacientesByEstado($estado)
    {
        return $this->model->where('estado', $estado)->get();
    }
}

