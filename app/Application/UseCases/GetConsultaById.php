<?php
namespace App\Application\UseCases;

use App\Application\Services\ConsultaService;

class GetConsultaById
{
    protected $consultaService;

    public function __construct(ConsultaService $consultaService)
    {
        $this->consultaService = $consultaService;
    }

    public function execute($id)
    {
        return $this->consultaService->obtenerConsultaPorId($id);
    }
}
