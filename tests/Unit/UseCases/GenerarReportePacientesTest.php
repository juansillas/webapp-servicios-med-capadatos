<?php

namespace Tests\Unit\UseCases;

use Tests\TestCase;
use App\Application\UseCases\GenerarReportePacientes;
use App\Application\Services\ReporteService;
use Mockery;

class GenerarReportePacientesTest extends TestCase
{
    protected $reporteService;
    protected $generarReportePacientes;

    public function setUp(): void
    {
        parent::setUp();

        // Crear un mock del servicio de Reporte
        $this->reporteService = Mockery::mock(ReporteService::class);

        // Crear la instancia de GenerarReportePacientes inyectando el mock del servicio de Reporte
        $this->generarReportePacientes = new GenerarReportePacientes($this->reporteService);
    }

    public function tearDown(): void
    {
        Mockery::close(); // Cerrar Mockery después de las pruebas
        parent::tearDown(); // Llamar al tearDown() de la clase padre
    }

    public function test_can_generate_pacientes_report()
    {
        // Criterios de prueba para generar el reporte
        $criterios = [
            'fecha_inicio' => '2024-09-01',
            'fecha_fin' => '2024-09-30',
            'estado' => 'Activo'
        ];

        // Datos de reporte simulados
        $reporte = [
            ['paciente_id' => 1, 'nombre' => 'Juan Pérez', 'estado' => 'Activo'],
            ['paciente_id' => 2, 'nombre' => 'María Gómez', 'estado' => 'Activo']
        ];

        // Definir expectativa: Simular la llamada al método generarReportePacientes del servicio de Reporte
        $this->reporteService->shouldReceive('generarReportePacientes')
            ->with($criterios)
            ->once()
            ->andReturn($reporte); // Devolver el reporte simulado

        // Ejecutar el método que queremos probar en el caso de uso
        $result = $this->generarReportePacientes->execute($criterios);

        // Verificar que el resultado es el esperado
        $this->assertEquals($reporte, $result);
    }
}
