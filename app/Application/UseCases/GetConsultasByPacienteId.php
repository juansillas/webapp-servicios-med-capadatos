<?php
namespace App\Application\UseCases;

use App\Application\Services\ConsultaService;

class GetConsultasByPacienteId
{
    protected $consultaService;

    public function __construct(ConsultaService $consultaService)
    {
        $this->consultaService = $consultaService;
    }

    public function execute($pacienteId)
    {
        return $this->consultaService->obtenerConsultasPorPaciente($pacienteId);
    }
}
