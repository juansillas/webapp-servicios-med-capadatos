<?php

namespace Tests\Unit\UseCases;

use Tests\TestCase;
use App\Application\UseCases\GenerarReporteUsoQuirofanos;
use App\Application\Services\ReporteService;
use Mockery;

class GenerarReporteUsoQuirofanosTest extends TestCase
{
    protected $reporteService;
    protected $generarReporteUsoQuirofanos;

    public function setUp(): void
    {
        parent::setUp();

        // Crear un mock del servicio de Reporte
        $this->reporteService = Mockery::mock(ReporteService::class);

        // Crear la instancia de GenerarReporteUsoQuirofanos inyectando el mock del servicio de Reporte
        $this->generarReporteUsoQuirofanos = new GenerarReporteUsoQuirofanos($this->reporteService);
    }

    public function tearDown(): void
    {
        Mockery::close(); // Cerrar Mockery después de las pruebas
        parent::tearDown(); // Llamar al tearDown() de la clase padre
    }

    public function test_can_generate_uso_quirofanos_report()
    {
        // Criterios de prueba para generar el reporte
        $criterios = [
            'fecha_inicio' => '2024-09-01',
            'fecha_fin' => '2024-09-30',
            'ubicacion' => 'Sala de Operaciones 1'
        ];

        // Datos de reporte simulados
        $reporte = [
            ['quirofano_id' => 1, 'estado' => 'ocupado', 'ubicacion' => 'Sala de Operaciones 1'],
            ['quirofano_id' => 2, 'estado' => 'disponible', 'ubicacion' => 'Sala de Operaciones 1']
        ];

        // Definir expectativa: Simular la llamada al método generarReporteUsoQuirofanos del servicio de Reporte
        $this->reporteService->shouldReceive('generarReporteUsoQuirofanos')
            ->with($criterios)
            ->once()
            ->andReturn($reporte); // Devolver el reporte simulado

        // Ejecutar el método que queremos probar en el caso de uso
        $result = $this->generarReporteUsoQuirofanos->execute($criterios);

        // Verificar que el resultado es el esperado
        $this->assertEquals($reporte, $result);
    }
}
