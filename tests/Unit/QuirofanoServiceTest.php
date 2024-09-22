<?php

namespace Tests\Unit\Services;

use Tests\TestCase;
use App\Application\Services\QuirofanoService;
use App\Repositories\Contracts\QuirofanoRepositoryInterface;
use Mockery;

class QuirofanoServiceTest extends TestCase
{
    protected $quirofanoRepository;
    protected $quirofanoService;

    public function setUp(): void
    {
        parent::setUp();

        // Crear mock del repositorio de Quirofano
        $this->quirofanoRepository = Mockery::mock(QuirofanoRepositoryInterface::class);

        // Crear la instancia de QuirofanoService inyectando el mock
        $this->quirofanoService = new QuirofanoService($this->quirofanoRepository);
    }

    public function tearDown(): void
    {
        Mockery::close(); // Cerrar Mockery después de las pruebas
        parent::tearDown(); // Llamar al tearDown() de la clase padre
    }

    public function test_can_get_available_quirofanos()
    {
        // Datos de prueba: quirófanos disponibles
        $quirofanosDisponibles = [
            (object) ['id' => 1, 'estado' => 'disponible'],
            (object) ['id' => 2, 'estado' => 'disponible']
        ];

        // Definir expectativa: Simular la llamada al repositorio
        $this->quirofanoRepository->shouldReceive('getAvailableQuirofanos')
            ->once()
            ->andReturn($quirofanosDisponibles);

        // Ejecutar el método que queremos probar
        $result = $this->quirofanoService->obtenerQuirofanosDisponibles();

        // Verificar que el resultado contiene los quirófanos esperados
        $this->assertEquals($quirofanosDisponibles, $result);
    }

    public function test_can_get_quirofanos_by_estado()
    {
        // Datos de prueba: quirófanos por estado
        $estado = 'ocupado';
        $quirofanosPorEstado = [
            (object) ['id' => 3, 'estado' => 'ocupado'],
            (object) ['id' => 4, 'estado' => 'ocupado']
        ];

        // Definir expectativa: Simular la llamada al repositorio
        $this->quirofanoRepository->shouldReceive('getQuirofanosByEstado')
            ->with($estado)
            ->once()
            ->andReturn($quirofanosPorEstado);

        // Ejecutar el método que queremos probar
        $result = $this->quirofanoService->obtenerQuirofanosPorEstado($estado);

        // Verificar que el resultado contiene los quirófanos esperados
        $this->assertEquals($quirofanosPorEstado, $result);
    }
}
