<?php

namespace App\Repositories\Eloquent;

use App\Models\HistorialMedico;
use App\Repositories\Contracts\HistorialMedicoRepositoryInterface;

class HistorialMedicoRepository extends BaseRepository implements HistorialMedicoRepositoryInterface
{
    public function __construct(HistorialMedico $model)
    {
        parent::__construct($model);
    }

    public function getByPacienteId($pacienteId)
    {
        return $this->model->where('paciente_id', $pacienteId)->get();
    }

    public function getRecentHistorialMedico($pacienteId, $limit)
    {
        return $this->model->where('paciente_id', $pacienteId)
                           ->orderBy('fecha', 'desc')
                           ->limit($limit)
                           ->get();
    }
}
