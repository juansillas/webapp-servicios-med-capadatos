<?php

namespace App\Http\Controllers;

use App\Services\QuirofanoService;
use Illuminate\Http\Request;

class QuirofanoController extends Controller
{
    protected $quirofanoService;

    public function __construct(QuirofanoService $quirofanoService)
    {
        $this->quirofanoService = $quirofanoService;
    }

    public function obtenerQuirofanos()
    {
        $quirofanos = $this->quirofanoService->getAll();
        return response()->json($quirofanos, 200);
    }

    public function registrarQuirofano(Request $request)
    {
        $quirofano = $this->quirofanoService->registrarQuirofano($request->all());
        return response()->json($quirofano, 201);
    }

    public function actualizarQuirofano(Request $request, $quirofanoId)
    {
        $quirofano = $this->quirofanoService->actualizarQuirofano($quirofanoId, $request->all());
        return response()->json($quirofano, 200);
    }
}
