<?php

namespace App\Repositories\Contracts;

interface TurnoActualRepositoryInterface extends BaseRepositoryInterface
{
    public function getTurnosByMedico($medicoId);
    public function getTurnosByFecha($fecha);
}
