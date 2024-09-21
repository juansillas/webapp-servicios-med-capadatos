<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Application\UseCases\RegisterPersonalMedico;
use App\Application\UseCases\UpdatePersonalMedico;
use App\Application\UseCases\DeletePersonalMedico;
use App\Application\UseCases\GetPersonalMedicoById;
use App\Application\UseCases\GetAllPersonalMedico;
use App\Application\UseCases\AssignTurnoPersonalMedico;

class PersonalMedicoController extends Controller
{
    protected $registerPersonalMedico;
    protected $updatePersonalMedico;
    protected $deletePersonalMedico;
    protected $getPersonalMedicoById;
    protected $getAllPersonalMedico;
    protected $assignTurnoPersonalMedico;

    public function __construct(
        RegisterPersonalMedico $registerPersonalMedico,
        UpdatePersonalMedico $updatePersonalMedico,
        DeletePersonalMedico $deletePersonalMedico,
        GetPersonalMedicoById $getPersonalMedicoById,
        GetAllPersonalMedico $getAllPersonalMedico,
        AssignTurnoPersonalMedico $assignTurnoPersonalMedico
    ) {
        $this->registerPersonalMedico = $registerPersonalMedico;
        $this->updatePersonalMedico = $updatePersonalMedico;
        $this->deletePersonalMedico = $deletePersonalMedico;
        $this->getPersonalMedicoById = $getPersonalMedicoById;
        $this->getAllPersonalMedico = $getAllPersonalMedico;
        $this->assignTurnoPersonalMedico = $assignTurnoPersonalMedico;
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $personalMedico = $this->registerPersonalMedico->execute($data);
        return response()->json($personalMedico, 201);
    }

    public function update($id, Request $request)
    {
        $data = $request->all();
        $personalMedico = $this->updatePersonalMedico->execute($id, $data);
        return response()->json($personalMedico);
    }

    public function destroy($id)
    {
        $this->deletePersonalMedico->execute($id);
        return response()->json(['message' => 'Personal médico eliminado'], 200);
    }

    public function show($id)
    {
        $personalMedico = $this->getPersonalMedicoById->execute($id);
        return response()->json($personalMedico);
    }

    public function index()
    {
        $personalMedico = $this->getAllPersonalMedico->execute();
        return response()->json($personalMedico);
    }

    public function assignTurno(Request $request)
    {
        $data = $request->all();
        $turno = $this->assignTurnoPersonalMedico->execute($data);
        return response()->json($turno);
    }
}
