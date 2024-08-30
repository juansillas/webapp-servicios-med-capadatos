<?php

namespace App\Services;

use App\Repositories\Contracts\HistorialMedicoRepositoryInterface;

class HistorialMedicoService
{
    protected $historialMedicoRepository;

    public function __construct(HistorialMedicoRepositoryInterface $historialMedicoRepository)
    {
        $this->historialMedicoRepository = $historialMedicoRepository;
    }

    public function obtenerHistorialReciente($pacienteId, $limit = 5)
    {
        return $this->historialMedicoRepository->getRecentHistorialMedico($pacienteId, $limit);
    }

    // Más métodos que encapsulan la lógica de negocio...
}
