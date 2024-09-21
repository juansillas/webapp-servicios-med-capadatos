<?php
namespace App\Application\UseCases;

use App\Application\Services\PacienteService;

class GetPacientesByEstado
{
    protected $pacienteService;

    public function __construct(PacienteService $pacienteService)
    {
        $this->pacienteService = $pacienteService;
    }

    public function execute($estado)
    {
        return $this->pacienteService->obtenerPacientesPorEstado($estado);
    }
}
