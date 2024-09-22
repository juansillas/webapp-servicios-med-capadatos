<?php

namespace App\Application\Services;

use App\Repositories\Contracts\EquipoMedicoRepositoryInterface;

class EquipoMedicoService
{
    protected $equipoMedicoRepository;

    public function __construct(EquipoMedicoRepositoryInterface $equipoMedicoRepository)
    {
        $this->equipoMedicoRepository = $equipoMedicoRepository;
    }

    public function obtenerEquiposDisponibles()
    {
        return $this->equipoMedicoRepository->getAvailableEquipos();
    }

    public function obtenerEquiposPorUbicacion($ubicacion)
    {
        return $this->equipoMedicoRepository->getEquiposByUbicacion($ubicacion);
    }

    // Más métodos que encapsulan la lógica de negocio...
}
