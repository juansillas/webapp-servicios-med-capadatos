<?php

namespace App\Http\Controllers;

use App\Services\PacienteService;
use Illuminate\Http\Request;

class PacienteController extends Controller
{
    protected $pacienteService;

    public function __construct(PacienteService $pacienteService)
    {
        $this->pacienteService = $pacienteService;
    }

    public function obtenerPacienteConDetalles($pacienteId)
    {
        $pacienteDetalles = $this->pacienteService->obtenerPacienteConDetalles($pacienteId);
        return response()->json($pacienteDetalles, 200);
    }

    public function registrarPaciente(Request $request)
    {
        $data = $request->all();
        $paciente = $this->pacienteService->registrarPacienteConDetalles(
            $data['paciente'],
            $data['historial_medico'],
            $data['ubicacion_actual'],
            $data['consultas']
        );
        return response()->json($paciente, 201);
    }
}
