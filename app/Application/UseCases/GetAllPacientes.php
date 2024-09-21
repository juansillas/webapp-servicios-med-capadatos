<?php
namespace App\Application\UseCases;

use App\Application\Services\PacienteService;

class GetAllPacientes
{
    protected $pacienteService;

    public function __construct(PacienteService $pacienteService)
    {
        $this->pacienteService = $pacienteService;
    }

    public function execute()
    {
        return $this->pacienteService->obtenerTodosLosPacientes();
    }
}
