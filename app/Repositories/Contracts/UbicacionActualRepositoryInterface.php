<?php

namespace App\Repositories\Contracts;

interface UbicacionActualRepositoryInterface extends BaseRepositoryInterface
{
    public function getByPacienteId($pacienteId);
    public function getPacientesByTipoUbicacion($tipoUbicacion);
}
