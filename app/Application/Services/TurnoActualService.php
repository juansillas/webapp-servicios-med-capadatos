<?php

namespace App\Services;

use App\Repositories\Contracts\TurnoActualRepositoryInterface;

class TurnoActualService
{
    protected $turnoActualRepository;

    public function __construct(TurnoActualRepositoryInterface $turnoActualRepository)
    {
        $this->turnoActualRepository = $turnoActualRepository;
    }

    public function obtenerTurnosPorMedico($medicoId)
    {
        return $this->turnoActualRepository->getTurnosByMedico($medicoId);
    }

    public function obtenerTurnosPorFecha($fecha)
    {
        return $this->turnoActualRepository->getTurnosByFecha($fecha);
    }

    // Más métodos que encapsulan la lógica de negocio...
}
