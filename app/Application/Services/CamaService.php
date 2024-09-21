<?php

namespace App\Services;

use App\Repositories\Contracts\CamaRepositoryInterface;

class CamaService
{
    protected $camaRepository;

    public function __construct(CamaRepositoryInterface $camaRepository)
    {
        $this->camaRepository = $camaRepository;
    }

    public function obtenerCamasDisponibles()
    {
        return $this->camaRepository->getAvailableCamas();
    }

    public function obtenerCamasPorUbicacion($ubicacion)
    {
        return $this->camaRepository->getCamasByUbicacion($ubicacion);
    }

    // Más métodos que encapsulan la lógica de negocio...
}
