<?php

namespace App\Application\Services;

use App\Repositories\Contracts\QuirofanoRepositoryInterface;

class QuirofanoService
{
    protected $quirofanoRepository;

    public function __construct(QuirofanoRepositoryInterface $quirofanoRepository)
    {
        $this->quirofanoRepository = $quirofanoRepository;
    }

    public function obtenerQuirofanosDisponibles()
    {
        return $this->quirofanoRepository->getAvailableQuirofanos();
    }

    public function obtenerQuirofanosPorEstado($estado)
    {
        return $this->quirofanoRepository->getQuirofanosByEstado($estado);
    }

    // Más métodos que encapsulan la lógica de negocio...
}
