<?php

namespace Tests\Unit\Services;

use Tests\TestCase;
use App\Services\EquipoMedicoService;
use App\Repositories\Contracts\EquipoMedicoRepositoryInterface;
use Mockery;

class EquipoMedicoServiceTest extends TestCase
{
    protected $equipoMedicoRepository;
    protected $equipoMedicoService;

    public function setUp(): void
    {
        parent::setUp();

        // Crear mock del repositorio de EquipoMedico
        $this->equipoMedicoRepository = Mockery::mock(EquipoMedicoRepositoryInterface::class);

        // Crear la instancia de EquipoMedicoService inyectando el mock
        $this->equipoMedicoService = new EquipoMedicoService($this->equipoMedicoRepository);
    }

    public function tearDown(): void
    {
        Mockery::close(); // Cerrar Mockery después de las pruebas
        parent::tearDown(); // Llamar al tearDown() de la clase padre
    }

    public function test_can_get_available_equipos()
    {
        // Datos de prueba: equipos disponibles
        $equiposDisponibles = [
            (object) ['id' => 1, 'nombre' => 'ECG', 'estado' => 'disponible'],
            (object) ['id' => 2, 'nombre' => 'Ultrasonido', 'estado' => 'disponible']
        ];

        // Definir expectativa: Simular la llamada al repositorio
        $this->equipoMedicoRepository->shouldReceive('getAvailableEquipos')
            ->once()
            ->andReturn($equiposDisponibles);

        // Ejecutar el método que queremos probar
        $result = $this->equipoMedicoService->obtenerEquiposDisponibles();

        // Verificar que el resultado contiene los equipos esperados
        $this->assertEquals($equiposDisponibles, $result);
    }

    public function test_can_get_equipos_by_ubicacion()
    {
        // Datos de prueba: equipos en una ubicación específica
        $ubicacion = 'Sala 1';
        $equiposPorUbicacion = [
            (object) ['id' => 1, 'nombre' => 'ECG', 'ubicacion' => 'Sala 1']
        ];

        // Definir expectativa: Simular la llamada al repositorio
        $this->equipoMedicoRepository->shouldReceive('getEquiposByUbicacion')
            ->with($ubicacion)
            ->once()
            ->andReturn($equiposPorUbicacion);

        // Ejecutar el método que queremos probar
        $result = $this->equipoMedicoService->obtenerEquiposPorUbicacion($ubicacion);

        // Verificar que el resultado contiene los equipos esperados
        $this->assertEquals($equiposPorUbicacion, $result);
    }
}
