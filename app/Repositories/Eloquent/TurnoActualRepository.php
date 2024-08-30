<?php

namespace App\Repositories\Eloquent;

use App\Models\TurnoActual;
use App\Repositories\Contracts\TurnoActualRepositoryInterface;

class TurnoActualRepository extends BaseRepository implements TurnoActualRepositoryInterface
{
    public function __construct(TurnoActual $model)
    {
        parent::__construct($model);
    }

    public function getTurnosByMedico($medicoId)
    {
        return $this->model->where('personal_medico_id', $medicoId)->get();
    }

    public function getTurnosByFecha($fecha)
    {
        return $this->model->whereDate('fecha_inicio', '<=', $fecha)
                           ->whereDate('fecha_fin', '>=', $fecha)
                           ->get();
    }
}
