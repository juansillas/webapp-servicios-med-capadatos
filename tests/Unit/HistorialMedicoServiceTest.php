<?php

namespace Tests\Unit\Services;

use Tests\TestCase;
use App\Application\Services\HistorialMedicoService;
use App\Repositories\Contracts\HistorialMedicoRepositoryInterface;
use Mockery;

class HistorialMedicoServiceTest extends TestCase
{
    protected $historialMedicoRepository;
    protected $historialMedicoService;

    public function setUp(): void
    {
        parent::setUp();

        // Crear mock del repositorio de HistorialMedico
        $this->historialMedicoRepository = Mockery::mock(HistorialMedicoRepositoryInterface::class);

        // Crear la instancia de HistorialMedicoService inyectando el mock
        $this->historialMedicoService = new HistorialMedicoService($this->historialMedicoRepository);
    }

    public function tearDown(): void
    {
        Mockery::close(); // Cerrar Mockery después de las pruebas
        parent::tearDown(); // Llamar al tearDown() de la clase padre
    }

    public function test_can_get_recent_historial_medico()
    {
        // Datos de prueba: historial médico reciente
        $pacienteId = 1;
        $limit = 5;
        $historialReciente = [
            (object) ['id' => 1, 'detalle' => 'Consulta general', 'fecha' => '2024-09-01'],
            (object) ['id' => 2, 'detalle' => 'Chequeo anual', 'fecha' => '2024-09-10']
        ];

        // Definir expectativa: Simular la llamada al repositorio
        $this->historialMedicoRepository->shouldReceive('getRecentHistorialMedico')
            ->with($pacienteId, $limit)
            ->once()
            ->andReturn($historialReciente);

        // Ejecutar el método que queremos probar
        $result = $this->historialMedicoService->obtenerHistorialReciente($pacienteId, $limit);

        // Verificar que el resultado contiene el historial médico esperado
        $this->assertEquals($historialReciente, $result);
    }

    public function test_can_get_recent_historial_medico_with_default_limit()
    {
        // Datos de prueba: historial médico con límite predeterminado (5)
        $pacienteId = 1;
        $historialReciente = [
            (object) ['id' => 1, 'detalle' => 'Consulta general', 'fecha' => '2024-09-01'],
            (object) ['id' => 2, 'detalle' => 'Chequeo anual', 'fecha' => '2024-09-10']
        ];

        // Definir expectativa: Simular la llamada al repositorio
        $this->historialMedicoRepository->shouldReceive('getRecentHistorialMedico')
            ->with($pacienteId, 5)  // Límite predeterminado
            ->once()
            ->andReturn($historialReciente);

        // Ejecutar el método que queremos probar con el límite por defecto
        $result = $this->historialMedicoService->obtenerHistorialReciente($pacienteId);

        // Verificar que el resultado contiene el historial médico esperado
        $this->assertEquals($historialReciente, $result);
    }
}
