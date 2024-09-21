<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Application\UseCases\CreateConsulta;
use App\Application\UseCases\UpdateConsulta;
use App\Application\UseCases\DeleteConsulta;
use App\Application\UseCases\GetConsultaById;
use App\Application\UseCases\GetConsultasByPacienteId;

class ConsultaController extends Controller
{
    protected $createConsulta;
    protected $updateConsulta;
    protected $deleteConsulta;
    protected $getConsultaById;
    protected $getConsultasByPacienteId;

    public function __construct(
        CreateConsulta $createConsulta,
        UpdateConsulta $updateConsulta,
        DeleteConsulta $deleteConsulta,
        GetConsultaById $getConsultaById,
        GetConsultasByPacienteId $getConsultasByPacienteId
    ) {
        $this->createConsulta = $createConsulta;
        $this->updateConsulta = $updateConsulta;
        $this->deleteConsulta = $deleteConsulta;
        $this->getConsultaById = $getConsultaById;
        $this->getConsultasByPacienteId = $getConsultasByPacienteId;
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $consulta = $this->createConsulta->execute($data);
        return response()->json($consulta, 201);
    }

    public function update($id, Request $request)
    {
        $data = $request->all();
        $consulta = $this->updateConsulta->execute($id, $data);
        return response()->json($consulta);
    }

    public function destroy($id)
    {
        $this->deleteConsulta->execute($id);
        return response()->json(['message' => 'Consulta eliminada'], 200);
    }

    public function show($id)
    {
        $consulta = $this->getConsultaById->execute($id);
        return response()->json($consulta);
    }

    public function getByPaciente($pacienteId)
    {
        $consultas = $this->getConsultasByPacienteId->execute($pacienteId);
        return response()->json($consultas);
    }
}
