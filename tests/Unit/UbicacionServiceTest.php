<?php

namespace Tests\Unit\Services;

use Tests\TestCase;
use App\Application\Services\UbicacionService;
use App\Repositories\Contracts\UbicacionActualRepositoryInterface;
use Mockery;

class UbicacionServiceTest extends TestCase
{
    protected $ubicacionActualRepository;
    protected $ubicacionService;

    public function setUp(): void
    {
        parent::setUp();

        // Crear mock del repositorio de UbicacionActual
        $this->ubicacionActualRepository = Mockery::mock(UbicacionActualRepositoryInterface::class);

        // Crear la instancia de UbicacionService inyectando el mock
        $this->ubicacionService = new UbicacionService($this->ubicacionActualRepository);
    }

    public function tearDown(): void
    {
        Mockery::close(); // Cerrar Mockery después de las pruebas
        parent::tearDown(); // Llamar al tearDown() de la clase padre
    }

    public function test_can_get_ubicaciones_by_tipo()
    {
        // Datos de prueba: ubicaciones por tipo
        $tipoUbicacion = 'Urgencias';
        $ubicaciones = [
            (object) ['id' => 1, 'paciente_id' => 1, 'ubicacion' => 'Urgencias'],
            (object) ['id' => 2, 'paciente_id' => 2, 'ubicacion' => 'Urgencias']
        ];

        // Definir expectativa: Simular la llamada al repositorio
        $this->ubicacionActualRepository->shouldReceive('getPacientesByTipoUbicacion')
            ->with($tipoUbicacion)
            ->once()
            ->andReturn($ubicaciones);

        // Ejecutar el método que queremos probar
        $result = $this->ubicacionService->obtenerUbicacionesPorTipo($tipoUbicacion);

        // Verificar que el resultado contiene las ubicaciones esperadas
        $this->assertEquals($ubicaciones, $result);
    }
}
