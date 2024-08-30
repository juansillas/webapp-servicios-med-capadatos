<?php

namespace App\Repositories\Contracts;

interface EquipoMedicoRepositoryInterface extends BaseRepositoryInterface
{
    public function getAvailableEquipos();
    public function getEquiposByUbicacion($ubicacion);
}
