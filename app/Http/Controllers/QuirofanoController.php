<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Application\UseCases\AsignarQuirofano;
use App\Application\UseCases\LiberarQuirofano;
use App\Application\UseCases\GetQuirofanoById;
use App\Application\UseCases\GetAllQuirofanos;

class QuirofanoController extends Controller
{
    protected $asignarQuirofano;
    protected $liberarQuirofano;
    protected $getQuirofanoById;
    protected $getAllQuirofanos;

    public function __construct(
        AsignarQuirofano $asignarQuirofano,
        LiberarQuirofano $liberarQuirofano,
        GetQuirofanoById $getQuirofanoById,
        GetAllQuirofanos $getAllQuirofanos
    ) {
        $this->asignarQuirofano = $asignarQuirofano;
        $this->liberarQuirofano = $liberarQuirofano;
        $this->getQuirofanoById = $getQuirofanoById;
        $this->getAllQuirofanos = $getAllQuirofanos;
    }

    public function asignar(Request $request)
    {
        $data = $request->all();
        $quirofano = $this->asignarQuirofano->execute($data);
        return response()->json($quirofano, 201);
    }

    public function liberar($id)
    {
        $this->liberarQuirofano->execute($id);
        return response()->json(['message' => 'Quirófano liberado'], 200);
    }

    public function show($id)
    {
        $quirofano = $this->getQuirofanoById->execute($id);
        return response()->json($quirofano);
    }

    public function index()
    {
        $quirofanos = $this->getAllQuirofanos->execute();
        return response()->json($quirofanos);
    }
}
