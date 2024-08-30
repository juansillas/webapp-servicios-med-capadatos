<?php

namespace App\Services;

use App\Repositories\Contracts\UbicacionActualRepositoryInterface;

class UbicacionService
{
    protected $ubicacionActualRepository;

    public function __construct(UbicacionActualRepositoryInterface $ubicacionActualRepository)
    {
        $this->ubicacionActualRepository = $ubicacionActualRepository;
    }

    public function obtenerUbicacionesPorTipo($tipoUbicacion)
    {
        return $this->ubicacionActualRepository->getPacientesByTipoUbicacion($tipoUbicacion);
    }

    // Más métodos que encapsulan la lógica de negocio...
}
