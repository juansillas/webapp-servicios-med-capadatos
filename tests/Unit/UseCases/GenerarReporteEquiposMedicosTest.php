<?php

namespace Tests\Unit\UseCases;

use Tests\TestCase;
use App\Application\UseCases\GenerarReporteEquiposMedicos;
use App\Application\Services\ReporteService;
use Mockery;

class GenerarReporteEquiposMedicosTest extends TestCase
{
    protected $reporteService;
    protected $generarReporteEquiposMedicos;

    public function setUp(): void
    {
        parent::setUp();

        // Crear un mock del servicio de Reporte
        $this->reporteService = Mockery::mock(ReporteService::class);

        // Crear la instancia de GenerarReporteEquiposMedicos inyectando el mock del servicio de Reporte
        $this->generarReporteEquiposMedicos = new GenerarReporteEquiposMedicos($this->reporteService);
    }

    public function tearDown(): void
    {
        Mockery::close(); // Cerrar Mockery después de las pruebas
        parent::tearDown(); // Llamar al tearDown() de la clase padre
    }

    public function test_can_generate_equipos_medicos_report()
    {
        // Criterios de prueba para generar el reporte
        $criterios = [
            'fecha_inicio' => '2024-09-01',
            'fecha_fin' => '2024-09-30',
            'ubicacion' => 'Sala de cirugía 1'
        ];

        // Datos de reporte simulados
        $reporte = [
            ['equipo_id' => 1, 'nombre' => 'ECG', 'ubicacion' => 'Sala de cirugía 1', 'estado' => 'en uso'],
            ['equipo_id' => 2, 'nombre' => 'Ventilador mecánico', 'ubicacion' => 'Sala de cirugía 1', 'estado' => 'disponible']
        ];

        // Definir expectativa: Simular la llamada al método generarReporteEquiposMedicos del servicio de Reporte
        $this->reporteService->shouldReceive('generarReporteEquiposMedicos')
            ->with($criterios)
            ->once()
            ->andReturn($reporte); // Devolver el reporte simulado

        // Ejecutar el método que queremos probar en el caso de uso
        $result = $this->generarReporteEquiposMedicos->execute($criterios);

        // Verificar que el resultado es el esperado
        $this->assertEquals($reporte, $result);
    }
}
