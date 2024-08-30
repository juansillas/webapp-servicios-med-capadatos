<?php

namespace App\Repositories\Eloquent;

use App\Models\UbicacionActual;
use App\Repositories\Contracts\UbicacionActualRepositoryInterface;

class UbicacionActualRepository extends BaseRepository implements UbicacionActualRepositoryInterface
{
    public function __construct(UbicacionActual $model)
    {
        parent::__construct($model);
    }

    public function getByPacienteId($pacienteId)
    {
        return $this->model->where('paciente_id', $pacienteId)->first();
    }

    public function getPacientesByTipoUbicacion($tipoUbicacion)
    {
        return $this->model->where('tipo_ubicacion', $tipoUbicacion)->get();
    }
}
