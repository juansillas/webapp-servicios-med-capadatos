<?php

namespace App\Services;

use App\Repositories\Contracts\ConsultaRepositoryInterface;

class ConsultaService
{
    protected $consultaRepository;

    public function __construct(ConsultaRepositoryInterface $consultaRepository)
    {
        $this->consultaRepository = $consultaRepository;
    }

    public function obtenerConsultasPorPaciente($pacienteId)
    {
        return $this->consultaRepository->getByPacienteId($pacienteId);
    }

    public function obtenerConsultasPorMedico($medicoId)
    {
        return $this->consultaRepository->getByMedicoId($medicoId);
    }

    public function obtenerConsultasPorFecha($fecha)
    {
        return $this->consultaRepository->getByFecha($fecha);
    }

    // Más métodos que encapsulan la lógica de negocio...
}
