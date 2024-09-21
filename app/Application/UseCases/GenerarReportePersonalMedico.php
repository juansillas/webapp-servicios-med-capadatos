<?php
namespace App\Application\UseCases;

use App\Application\Services\ReporteService;

class GenerarReportePersonalMedico
{
    protected $reporteService;

    public function __construct(ReporteService $reporteService)
    {
        $this->reporteService = $reporteService;
    }

    public function execute($criterios)
    {
        return $this->reporteService->generarReportePersonalMedico($criterios);
    }
}
