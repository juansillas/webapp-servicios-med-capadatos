<?php

namespace App\Application\UseCases;

use App\Application\Services\HistorialMedicoService;

class RegisterHistorialMedico
{
    protected $historialMedicoService;

    public function __construct(HistorialMedicoService $historialMedicoService)
    {
        $this->historialMedicoService = $historialMedicoService;
    }

    public function execute(array $data)
    {
        return $this->historialMedicoService->crearHistorialMedico($data);
    }
}
