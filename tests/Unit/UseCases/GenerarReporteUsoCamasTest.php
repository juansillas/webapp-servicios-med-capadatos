<?php

namespace Tests\Unit\UseCases;

use Tests\TestCase;
use App\Application\UseCases\GenerarReporteUsoCamas;
use App\Application\Services\ReporteService;
use Mockery;

class GenerarReporteUsoCamasTest extends TestCase
{
    protected $reporteService;
    protected $generarReporteUsoCamas;

    public function setUp(): void
    {
        parent::setUp();

        // Crear un mock del servicio de Reporte
        $this->reporteService = Mockery::mock(ReporteService::class);

        // Crear la instancia de GenerarReporteUsoCamas inyectando el mock del servicio de Reporte
        $this->generarReporteUsoCamas = new GenerarReporteUsoCamas($this->reporteService);
    }

    public function tearDown(): void
    {
        Mockery::close(); // Cerrar Mockery después de las pruebas
        parent::tearDown(); // Llamar al tearDown() de la clase padre
    }

    public function test_can_generate_uso_camas_report()
    {
        // Criterios de prueba para generar el reporte
        $criterios = [
            'fecha_inicio' => '2024-09-01',
            'fecha_fin' => '2024-09-30',
            'ubicacion' => 'Unidad de Cuidados Intensivos'
        ];

        // Datos de reporte simulados
        $reporte = [
            ['cama_id' => 1, 'estado' => 'ocupada', 'ubicacion' => 'Unidad de Cuidados Intensivos'],
            ['cama_id' => 2, 'estado' => 'disponible', 'ubicacion' => 'Unidad de Cuidados Intensivos']
        ];

        // Definir expectativa: Simular la llamada al método generarReporteUsoCamas del servicio de Reporte
        $this->reporteService->shouldReceive('generarReporteUsoCamas')
            ->with($criterios)
            ->once()
            ->andReturn($reporte); // Devolver el reporte simulado

        // Ejecutar el método que queremos probar en el caso de uso
        $result = $this->generarReporteUsoCamas->execute($criterios);

        // Verificar que el resultado es el esperado
        $this->assertEquals($reporte, $result);
    }
}
