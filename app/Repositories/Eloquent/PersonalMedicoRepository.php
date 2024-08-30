<?php

namespace App\Repositories\Eloquent;

use App\Models\PersonalMedico;
use App\Repositories\Contracts\PersonalMedicoRepositoryInterface;

class PersonalMedicoRepository extends BaseRepository implements PersonalMedicoRepositoryInterface
{
    public function __construct(PersonalMedico $model)
    {
        parent::__construct($model);
    }

    public function findByEspecialidad($especialidad)
    {
        return $this->model->where('especialidad', $especialidad)->get();
    }

    public function findByTurno($turnoId)
    {
        return $this->model->whereHas('turnos', function($query) use ($turnoId) {
            $query->where('id', $turnoId);
        })->get();
    }

    public function getDisponiblesParaTurno($fechaInicio, $fechaFin)
    {
        return $this->model->whereDoesntHave('turnos', function($query) use ($fechaInicio, $fechaFin) {
            $query->whereBetween('fecha_inicio', [$fechaInicio, $fechaFin])
                  ->orWhereBetween('fecha_fin', [$fechaInicio, $fechaFin]);
        })->get();
    }
}
