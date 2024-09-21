<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Application\UseCases\GenerarReportePacientes;
use App\Application\UseCases\GenerarReporteConsultas;
use App\Application\UseCases\GenerarReportePersonalMedico;
use App\Application\UseCases\GenerarReporteUsoCamas;
use App\Application\UseCases\GenerarReporteUsoQuirofanos;
use App\Application\UseCases\GenerarReporteEquiposMedicos;

class ReporteController extends Controller
{
    protected $generarReportePacientes;
    protected $generarReporteConsultas;
    protected $generarReportePersonalMedico;
    protected $generarReporteUsoCamas;
    protected $generarReporteUsoQuirofanos;
    protected $generarReporteEquiposMedicos;

    public function __construct(
        GenerarReportePacientes $generarReportePacientes,
        GenerarReporteConsultas $generarReporteConsultas,
        GenerarReportePersonalMedico $generarReportePersonalMedico,
        GenerarReporteUsoCamas $generarReporteUsoCamas,
        GenerarReporteUsoQuirofanos $generarReporteUsoQuirofanos,
        GenerarReporteEquiposMedicos $generarReporteEquiposMedicos
    ) {
        $this->generarReportePacientes = $generarReportePacientes;
        $this->generarReporteConsultas = $generarReporteConsultas;
        $this->generarReportePersonalMedico = $generarReportePersonalMedico;
        $this->generarReporteUsoCamas = $generarReporteUsoCamas;
        $this->generarReporteUsoQuirofanos = $generarReporteUsoQuirofanos;
        $this->generarReporteEquiposMedicos = $generarReporteEquiposMedicos;
    }

    public function generarReportePacientes(Request $request)
    {
        $criterios = $request->all();
        $reporte = $this->generarReportePacientes->execute($criterios);
        return response()->json($reporte);
    }

    public function generarReporteConsultas(Request $request)
    {
        $criterios = $request->all();
        $reporte = $this->generarReporteConsultas->execute($criterios);
        return response()->json($reporte);
    }

    public function generarReportePersonalMedico(Request $request)
    {
        $criterios = $request->all();
        $reporte = $this->generarReportePersonalMedico->execute($criterios);
        return response()->json($reporte);
    }

    public function generarReporteUsoCamas(Request $request)
    {
        $criterios = $request->all();
        $reporte = $this->generarReporteUsoCamas->execute($criterios);
        return response()->json($reporte);
    }

    public function generarReporteUsoQuirofanos(Request $request)
    {
        $criterios = $request->all();
        $reporte = $this->generarReporteUsoQuirofanos->execute($criterios);
        return response()->json($reporte);
    }

    public function generarReporteEquiposMedicos(Request $request)
    {
        $criterios = $request->all();
        $reporte = $this->generarReporteEquiposMedicos->execute($criterios);
        return response()->json($reporte);
    }
}
