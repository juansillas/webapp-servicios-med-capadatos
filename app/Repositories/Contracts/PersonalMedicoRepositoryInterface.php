<?php

namespace App\Repositories\Contracts;

interface PersonalMedicoRepositoryInterface extends BaseRepositoryInterface
{
    public function findByEspecialidad($especialidad);
    public function findByTurno($turnoId);
    public function getDisponiblesParaTurno($fechaInicio, $fechaFin);
}
