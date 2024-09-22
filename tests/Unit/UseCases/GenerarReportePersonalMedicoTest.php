<?php

namespace Tests\Unit\UseCases;

use Tests\TestCase;
use App\Application\UseCases\GenerarReportePersonalMedico;
use App\Application\Services\ReporteService;
use Mockery;

class GenerarReportePersonalMedicoTest extends TestCase
{
    protected $reporteService;
    protected $generarReportePersonalMedico;

    public function setUp(): void
    {
        parent::setUp();

        // Crear un mock del servicio de Reporte
        $this->reporteService = Mockery::mock(ReporteService::class);

        // Crear la instancia de GenerarReportePersonalMedico inyectando el mock del servicio de Reporte
        $this->generarReportePersonalMedico = new GenerarReportePersonalMedico($this->reporteService);
    }

    public function tearDown(): void
    {
        Mockery::close(); // Cerrar Mockery después de las pruebas
        parent::tearDown(); // Llamar al tearDown() de la clase padre
    }

    public function test_can_generate_personal_medico_report()
    {
        // Criterios de prueba para generar el reporte
        $criterios = [
            'fecha_inicio' => '2024-09-01',
            'fecha_fin' => '2024-09-30',
            'especialidad' => 'Cirugía'
        ];

        // Datos de reporte simulados
        $reporte = [
            ['medico_id' => 1, 'nombre' => 'Dr. Rodríguez', 'especialidad' => 'Cirugía', 'estado' => 'Activo'],
            ['medico_id' => 2, 'nombre' => 'Dr. López', 'especialidad' => 'Cirugía', 'estado' => 'Activo']
        ];

        // Definir expectativa: Simular la llamada al método generarReportePersonalMedico del servicio de Reporte
        $this->reporteService->shouldReceive('generarReportePersonalMedico')
            ->with($criterios)
            ->once()
            ->andReturn($reporte); // Devolver el reporte simulado

        // Ejecutar el método que queremos probar en el caso de uso
        $result = $this->generarReportePersonalMedico->execute($criterios);

        // Verificar que el resultado es el esperado
        $this->assertEquals($reporte, $result);
    }
}
