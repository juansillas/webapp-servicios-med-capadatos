<?php

namespace App\Repositories\Eloquent;

use App\Models\EquipoMedico;
use App\Repositories\Contracts\EquipoMedicoRepositoryInterface;

class EquipoMedicoRepository extends BaseRepository implements EquipoMedicoRepositoryInterface
{
    public function __construct(EquipoMedico $model)
    {
        parent::__construct($model);
    }

    public function getAvailableEquipos()
    {
        return $this->model->where('estado', 'Disponible')->get();
    }

    public function getEquiposByUbicacion($ubicacion)
    {
        return $this->model->where('ubicacion', $ubicacion)->get();
    }
}
