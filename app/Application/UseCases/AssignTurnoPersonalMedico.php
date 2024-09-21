<?php
namespace App\Application\UseCases;

use App\Application\Services\PersonalMedicoService;

class AssignTurnoPersonalMedico
{
    protected $personalMedicoService;

    public function __construct(PersonalMedicoService $personalMedicoService)
    {
        $this->personalMedicoService = $personalMedicoService;
    }

    public function execute(array $data)
    {
        return $this->personalMedicoService->asignarTurno($data);
    }
}
