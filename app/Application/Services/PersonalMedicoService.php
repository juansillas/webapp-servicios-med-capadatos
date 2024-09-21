<?php

namespace App\Services;

use App\Repositories\Contracts\PersonalMedicoRepositoryInterface;
use App\Repositories\Contracts\TurnoActualRepositoryInterface;

class PersonalMedicoService
{
    protected $personalMedicoRepository;
    protected $turnoActualRepository;

    public function __construct(
        PersonalMedicoRepositoryInterface $personalMedicoRepository,
        TurnoActualRepositoryInterface $turnoActualRepository
    ) {
        $this->personalMedicoRepository = $personalMedicoRepository;
        $this->turnoActualRepository = $turnoActualRepository;
    }

    public function obtenerMedicoConTurnos($medicoId)
    {
        $medico = $this->personalMedicoRepository->find($medicoId);
        $turnos = $this->turnoActualRepository->getTurnosByMedico($medicoId);

        return [
            'medico' => $medico,
            'turnos' => $turnos,
        ];
    }

    // Más métodos que encapsulan la lógica de negocio...
}
