<?php

namespace App\Http\Controllers;

use App\Services\EquipoMedicoService;
use Illuminate\Http\Request;

class EquipoMedicoController extends Controller
{
    protected $equipoMedicoService;

    public function __construct(EquipoMedicoService $equipoMedicoService)
    {
        $this->equipoMedicoService = $equipoMedicoService;
    }

    public function obtenerEquiposMedicos()
    {
        $equipos = $this->equipoMedicoService->getAll();
        return response()->json($equipos, 200);
    }

    public function registrarEquipoMedico(Request $request)
    {
        $equipo = $this->equipoMedicoService->registrarEquipoMedico($request->all());
        return response()->json($equipo, 201);
    }

    public function actualizarEquipoMedico(Request $request, $equipoId)
    {
        $equipo = $this->equipoMedicoService->actualizarEquipoMedico($equipoId, $request->all());
        return response()->json($equipo, 200);
    }
}
