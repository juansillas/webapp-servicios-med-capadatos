<?php

namespace App\Repositories\Eloquent;

use App\Models\Consulta;
use App\Repositories\Contracts\ConsultaRepositoryInterface;

class ConsultaRepository extends BaseRepository implements ConsultaRepositoryInterface
{
    public function __construct(Consulta $model)
    {
        parent::__construct($model);
    }

    public function getByPacienteId($pacienteId)
    {
        return $this->model->where('paciente_id', $pacienteId)->get();
    }

    public function getByMedicoId($medicoId)
    {
        return $this->model->where('personal_medico_id', $medicoId)->get();
    }

    public function getByFecha($fecha)
    {
        return $this->model->whereDate('fecha', $fecha)->get();
    }
}
