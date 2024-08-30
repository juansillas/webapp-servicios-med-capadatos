<?php

namespace App\Repositories\Contracts;

interface HistorialMedicoRepositoryInterface extends BaseRepositoryInterface
{
    public function getByPacienteId($pacienteId);
    public function getRecentHistorialMedico($pacienteId, $limit);
}
