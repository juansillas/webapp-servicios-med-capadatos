<?php

namespace App\Application\Services;

use App\Repositories\Contracts\PacienteRepositoryInterface;
use App\Repositories\Contracts\HistorialMedicoRepositoryInterface;
use App\Repositories\Contracts\UbicacionActualRepositoryInterface;
use App\Repositories\Contracts\ConsultaRepositoryInterface;

class PacienteService
{
    protected $pacienteRepository;
    protected $historialMedicoRepository;
    protected $ubicacionActualRepository;
    protected $consultaRepository;

    public function __construct(
        PacienteRepositoryInterface $pacienteRepository,
        HistorialMedicoRepositoryInterface $historialMedicoRepository,
        UbicacionActualRepositoryInterface $ubicacionActualRepository,
        ConsultaRepositoryInterface $consultaRepository
    ) {
        $this->pacienteRepository = $pacienteRepository;
        $this->historialMedicoRepository = $historialMedicoRepository;
        $this->ubicacionActualRepository = $ubicacionActualRepository;
        $this->consultaRepository = $consultaRepository;
    }

    public function obtenerPacienteConDetalles($pacienteId)
    {
        $paciente = $this->pacienteRepository->find($pacienteId);
        $historial = $this->historialMedicoRepository->getByPacienteId($pacienteId);
        $ubicacion = $this->ubicacionActualRepository->getByPacienteId($pacienteId);
        $consultas = $this->consultaRepository->getByPacienteId($pacienteId);

        return [
            'paciente' => $paciente,
            'historial' => $historial,
            'ubicacion' => $ubicacion,
            'consultas' => $consultas,
        ];
    }

    // Más métodos que encapsulan la lógica de negocio...
    // Método para crear un paciente
    public function crearPaciente(array $data)
    {
        return $this->pacienteRepository->create($data);
    }
}
