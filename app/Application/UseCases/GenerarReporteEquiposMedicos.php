<?php
namespace App\Application\UseCases;

use App\Application\Services\ReporteService;

class GenerarReporteEquiposMedicos
{
    protected $reporteService;

    public function __construct(ReporteService $reporteService)
    {
        $this->reporteService = $reporteService;
    }

    public function execute($criterios)
    {
        return $this->reporteService->generarReporteEquiposMedicos($criterios);
    }
}