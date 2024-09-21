<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Application\UseCases\RegisterPaciente;
use App\Application\UseCases\UpdatePaciente;
use App\Application\UseCases\DeletePaciente;
use App\Application\UseCases\GetPacienteById;
use App\Application\UseCases\GetAllPacientes;
use App\Application\UseCases\GetPacientesByEstado;

class PacienteController extends Controller
{
    protected $registerPaciente;
    protected $updatePaciente;
    protected $deletePaciente;
    protected $getPacienteById;
    protected $getAllPacientes;
    protected $getPacientesByEstado;

    public function __construct(
        RegisterPaciente $registerPaciente,
        UpdatePaciente $updatePaciente,
        DeletePaciente $deletePaciente,
        GetPacienteById $getPacienteById,
        GetAllPacientes $getAllPacientes,
        GetPacientesByEstado $getPacientesByEstado
    ) {
        $this->registerPaciente = $registerPaciente;
        $this->updatePaciente = $updatePaciente;
        $this->deletePaciente = $deletePaciente;
        $this->getPacienteById = $getPacienteById;
        $this->getAllPacientes = $getAllPacientes;
        $this->getPacientesByEstado = $getPacientesByEstado;
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $paciente = $this->registerPaciente->execute($data);
        return response()->json($paciente, 201);
    }

    public function update($id, Request $request)
    {
        $data = $request->all();
        $paciente = $this->updatePaciente->execute($id, $data);
        return response()->json($paciente);
    }

    public function destroy($id)
    {
        $this->deletePaciente->execute($id);
        return response()->json(['message' => 'Paciente eliminado'], 200);
    }

    public function show($id)
    {
        $paciente = $this->getPacienteById->execute($id);
        return response()->json($paciente);
    }

    public function index()
    {
        $pacientes = $this->getAllPacientes->execute();
        return response()->json($pacientes);
    }

    public function getByEstado($estado)
    {
        $pacientes = $this->getPacientesByEstado->execute($estado);
        return response()->json($pacientes);
    }
}
