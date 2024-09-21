<?php

namespace App\Application\UseCases;

use App\Application\Services\ConsultaService;

class UpdateConsulta
{
    protected $consultaService;

    public function __construct(ConsultaService $consultaService)
    {
        $this->consultaService = $consultaService;
    }

    public function execute($id, array $data)
    {
        return $this->consultaService->actualizarConsulta($id, $data);
    }
}
