<?php

namespace App\Http\Controllers;

use App\Services\CamaService;
use Illuminate\Http\Request;

class CamaController extends Controller
{
    protected $camaService;

    public function __construct(CamaService $camaService)
    {
        $this->camaService = $camaService;
    }

    public function obtenerCamas()
    {
        $camas = $this->camaService->getAll();
        return response()->json($camas, 200);
    }

    public function registrarCama(Request $request)
    {
        $cama = $this->camaService->registrarCama($request->all());
        return response()->json($cama, 201);
    }

    public function actualizarCama(Request $request, $camaId)
    {
        $cama = $this->camaService->actualizarCama($camaId, $request->all());
        return response()->json($cama, 200);
    }
}
