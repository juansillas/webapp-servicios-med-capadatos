<?php

namespace App\Services;

use App\Repositories\Contracts\PacienteRepositoryInterface;
use App\Repositories\Contracts\HistorialMedicoRepositoryInterface;
use App\Repositories\Contracts\UbicacionActualRepositoryInterface;
use App\Repositories\Contracts\ConsultaRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

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

    // Implementación del método crítico con gestión de transacciones
    public function registrarPacienteConDetalles(array $patientData, array $historyData, array $ubicacionData, array $consultaData)
    {
        try {
            // Comienza la transacción
            return DB::transaction(function () use ($patientData, $historyData, $ubicacionData, $consultaData) {
                // Crear el paciente
                $paciente = $this->pacienteRepository->create($patientData);

                // Crear historial médico relacionado
                $historyData['paciente_id'] = $paciente->id;
                $this->historialMedicoRepository->create($historyData);

                // Crear la ubicación actual del paciente
                $ubicacionData['paciente_id'] = $paciente->id;
                $this->ubicacionActualRepository->create($ubicacionData);

                // Crear consultas relacionadas
                foreach ($consultaData as $consulta) {
                    $consulta['paciente_id'] = $paciente->id;
                    $this->consultaRepository->create($consulta);
                }

                return $paciente; // Retorna el paciente creado
            });
        } catch (\Exception $e) {
            Log::error('Error al registrar el paciente con detalles: ' . $e->getMessage());
            throw $e; // Lanza la excepción para manejarla de forma adecuada
        }
    }
}
