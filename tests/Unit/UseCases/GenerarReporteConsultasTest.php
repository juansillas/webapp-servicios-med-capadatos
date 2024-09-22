<?php

namespace Tests\Unit\UseCases;

use Tests\TestCase;
use App\Application\UseCases\GenerarReporteConsultas;
use App\Application\Services\ReporteService;
use Mockery;

class GenerarReporteConsultasTest extends TestCase
{
    protected $reporteService;
    protected $generarReporteConsultas;

    public function setUp(): void
    {
        parent::setUp();

        // Crear un mock del servicio de Reporte
        $this->reporteService = Mockery::mock(ReporteService::class);

        // Crear la instancia de GenerarReporteConsultas inyectando el mock del servicio de Reporte
        $this->generarReporteConsultas = new GenerarReporteConsultas($this->reporteService);
    }

    public function tearDown(): void
    {
        Mockery::close(); // Cerrar Mockery después de las pruebas
        parent::tearDown(); // Llamar al tearDown() de la clase padre
    }

    public function test_can_generate_consultas_report()
    {
        // Criterios de prueba para generar el reporte
        $criterios = [
            'fecha_inicio' => '2024-09-01',
            'fecha_fin' => '2024-09-30',
            'medico_id' => 1
        ];

        // Datos de reporte simulados
        $reporte = [
            ['consulta_id' => 1, 'paciente' => 'Juan Pérez', 'medico' => 'Dr. Rodríguez', 'fecha' => '2024-09-10'],
            ['consulta_id' => 2, 'paciente' => 'María Gómez', 'medico' => 'Dr. Rodríguez', 'fecha' => '2024-09-12']
        ];

        // Definir expectativa: Simular la llamada al método generarReporteConsultas del servicio de Reporte
        $this->reporteService->shouldReceive('generarReporteConsultas')
            ->with($criterios)
            ->once()
            ->andReturn($reporte); // Devolver el reporte simulado

        // Ejecutar el método que queremos probar en el caso de uso
        $result = $this->generarReporteConsultas->execute($criterios);

        // Verificar que el resultado es el esperado
        $this->assertEquals($reporte, $result);
    }
}
