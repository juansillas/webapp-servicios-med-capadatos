<?php
namespace App\Application\UseCases;

use App\Application\Services\ConsultaService;

class CreateConsulta
{
    protected $consultaService;

    public function __construct(ConsultaService $consultaService)
    {
        $this->consultaService = $consultaService;
    }

    public function execute(array $data)
    {
        return $this->consultaService->crearConsulta($data);
    }
}
