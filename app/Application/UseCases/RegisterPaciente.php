<?php

namespace App\Application\UseCases;

use App\Application\Services\PacienteService;

class RegisterPaciente
{
    protected $pacienteService;

    public function __construct(PacienteService $pacienteService)
    {
        $this->pacienteService = $pacienteService;
    }

    public function execute(array $data)
    {
        // Validación y procesamiento de datos
        return $this->pacienteService->crearPaciente($data);
    }
}
