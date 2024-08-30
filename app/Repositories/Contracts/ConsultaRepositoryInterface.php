<?php

namespace App\Repositories\Contracts;

interface ConsultaRepositoryInterface extends BaseRepositoryInterface
{
    public function getByPacienteId($pacienteId);
    public function getByMedicoId($medicoId);
    public function getByFecha($fecha);
}
