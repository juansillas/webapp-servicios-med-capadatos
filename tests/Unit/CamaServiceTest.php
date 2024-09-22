<?php

namespace Tests\Unit\Services;

use Tests\TestCase;
use App\Application\Services\CamaService;
use App\Repositories\Contracts\CamaRepositoryInterface;
use Mockery;

class CamaServiceTest extends TestCase
{
    protected $camaRepository;
    protected $camaService;

    public function setUp(): void
    {
        parent::setUp();

        // Crear mock del repositorio de Cama
        $this->camaRepository = Mockery::mock(CamaRepositoryInterface::class);

        // Crear la instancia de CamaService inyectando el mock
        $this->camaService = new CamaService($this->camaRepository);
    }

    public function tearDown(): void
    {
        Mockery::close(); // Cerrar Mockery después de las pruebas
        parent::tearDown(); // Llamar al tearDown() de la clase padre
    }

    public function test_can_get_available_camas()
    {
        // Datos de prueba: camas disponibles
        $camasDisponibles = [
            (object) ['id' => 1, 'ubicacion' => 'Sala 1', 'estado' => 'disponible'],
            (object) ['id' => 2, 'ubicacion' => 'Sala 2', 'estado' => 'disponible']
        ];

        // Definir expectativa: Simular la llamada al repositorio
        $this->camaRepository->shouldReceive('getAvailableCamas')
            ->once()
            ->andReturn($camasDisponibles);

        // Ejecutar el método que queremos probar
        $result = $this->camaService->obtenerCamasDisponibles();

        // Verificar que el resultado contiene las camas esperadas
        $this->assertEquals($camasDisponibles, $result);
    }

    public function test_can_get_camas_by_ubicacion()
    {
        // Datos de prueba: camas en una ubicación específica
        $ubicacion = 'Sala 1';
        $camasPorUbicacion = [
            (object) ['id' => 1, 'ubicacion' => 'Sala 1', 'estado' => 'disponible']
        ];

        // Definir expectativa: Simular la llamada al repositorio
        $this->camaRepository->shouldReceive('getCamasByUbicacion')
            ->with($ubicacion)
            ->once()
            ->andReturn($camasPorUbicacion);

        // Ejecutar el método que queremos probar
        $result = $this->camaService->obtenerCamasPorUbicacion($ubicacion);

        // Verificar que el resultado contiene las camas esperadas
        $this->assertEquals($camasPorUbicacion, $result);
    }
}
