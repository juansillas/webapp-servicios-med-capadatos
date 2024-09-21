<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Application\UseCases\AsignarCama;
use App\Application\UseCases\LiberarCama;
use App\Application\UseCases\GetCamaById;
use App\Application\UseCases\GetAllCamas;

class CamaController extends Controller
{
    protected $asignarCama;
    protected $liberarCama;
    protected $getCamaById;
    protected $getAllCamas;

    public function __construct(
        AsignarCama $asignarCama,
        LiberarCama $liberarCama,
        GetCamaById $getCamaById,
        GetAllCamas $getAllCamas
    ) {
        $this->asignarCama = $asignarCama;
        $this->liberarCama = $liberarCama;
        $this->getCamaById = $getCamaById;
        $this->getAllCamas = $getAllCamas;
    }
    public function asignar(Request $request)
    {
        $data = $request->all();
        $cama = $this->asignarCama->execute($data);
        return response()->json($cama, 201);
    }

    public function liberar($id)
    {
        $this->liberarCama->execute($id);
        return response()->json(['message' => 'Cama liberada'], 200);
    }

    public function show($id)
    {
        $cama = $this->getCamaById->execute($id);
        return response()->json($cama);
    }

    public function index()
    {
        $camas = $this->getAllCamas->execute();
        return response()->json($camas);
    }
}
