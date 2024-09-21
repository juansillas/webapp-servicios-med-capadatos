<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Application\UseCases\AsignarEquipoMedico;
use App\Application\UseCases\LiberarEquipoMedico;
use App\Application\UseCases\GetEquipoMedicoById;
use App\Application\UseCases\GetAllEquiposMedicos;

class EquipoMedicoController extends Controller
{
    protected $asignarEquipoMedico;
    protected $liberarEquipoMedico;
    protected $getEquipoMedicoById;
    protected $getAllEquiposMedicos;

    public function __construct(
        AsignarEquipoMedico $asignarEquipoMedico,
        LiberarEquipoMedico $liberarEquipoMedico,
        GetEquipoMedicoById $getEquipoMedicoById,
        GetAllEquiposMedicos $getAllEquiposMedicos
    ) {
        $this->asignarEquipoMedico = $asignarEquipoMedico;
        $this->liberarEquipoMedico = $liberarEquipoMedico;
        $this->getEquipoMedicoById = $getEquipoMedicoById;
        $this->getAllEquiposMedicos = $getAllEquiposMedicos;
    }

    public function asignar(Request $request)
    {
        $data = $request->all();
        $equipo = $this->asignarEquipoMedico->execute($data);
        return response()->json($equipo, 201);
    }

    public function liberar($id)
    {
        $this->liberarEquipoMedico->execute($id);
        return response()->json(['message' => 'Equipo médico liberado'], 200);
    }

    public function show($id)
    {
        $equipo = $this->getEquipoMedicoById->execute($id);
        return response()->json($equipo);
    }

    public function index()
    {
        $equipos = $this->getAllEquiposMedicos->execute();
        return response()->json($equipos);
    }
}
