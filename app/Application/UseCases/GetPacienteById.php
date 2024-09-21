<?php
namespace App\Application\UseCases;

use App\Application\Services\PacienteService;

class GetPacienteById
{
    protected $pacienteService;

    public function __construct(PacienteService $pacienteService)
    {
        $this->pacienteService = $pacienteService;
    }

    public function execute($id)
    {
        return $this->pacienteService->obtenerPacientePorId($id);
    }
}
