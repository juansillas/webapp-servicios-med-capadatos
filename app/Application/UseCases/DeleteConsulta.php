<?php
namespace App\Application\UseCases;

use App\Application\Services\ConsultaService;

class DeleteConsulta
{
    protected $consultaService;

    public function __construct(ConsultaService $consultaService)
    {
        $this->consultaService = $consultaService;
    }

    public function execute($id)
    {
        return $this->consultaService->eliminarConsulta($id);
    }
}
