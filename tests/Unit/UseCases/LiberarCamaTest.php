<?php

namespace Tests\Unit\UseCases;

use Tests\TestCase;
use App\Application\UseCases\LiberarCama;
use App\Application\Services\CamaService;
use Mockery;

class LiberarCamaTest extends TestCase
{
    protected $camaService;
    protected $liberarCama;

    public function setUp(): void
    {
        parent::setUp();

        // Crear un mock del servicio de Cama
        $this->camaService = Mockery::mock(CamaService::class);

        // Crear la instancia de LiberarCama inyectando el mock del servicio de Cama
        $this->liberarCama = new LiberarCama($this->camaService);
    }

    public function tearDown(): void
    {
        Mockery::close(); // Cerrar Mockery después de las pruebas
        parent::tearDown(); // Llamar al tearDown() de la clase padre
    }

    public function test_can_liberar_cama()
    {
        // ID de cama de prueba
        $camaId = 1;

        // Definir expectativa: Simular la llamada al método liberarCama del servicio de Cama
        $this->camaService->shouldReceive('liberarCama')
            ->with($camaId)
            ->once()
            ->andReturn(true); // Simular que la cama fue liberada correctamente

        // Ejecutar el método que queremos probar en el caso de uso
        $result = $this->liberarCama->execute($camaId);

        // Verificar que el resultado es el esperado
        $this->assertTrue($result);
    }
}
