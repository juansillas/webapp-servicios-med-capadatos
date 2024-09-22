<?php

namespace Tests\Unit\UseCases;

use Tests\TestCase;
use App\Application\UseCases\LiberarQuirofano;
use App\Application\Services\QuirofanoService;
use Mockery;

class LiberarQuirofanoTest extends TestCase
{
    protected $quirofanoService;
    protected $liberarQuirofano;

    public function setUp(): void
    {
        parent::setUp();

        // Crear un mock del servicio de Quirofano
        $this->quirofanoService = Mockery::mock(QuirofanoService::class);

        // Crear la instancia de LiberarQuirofano inyectando el mock del servicio de Quirofano
        $this->liberarQuirofano = new LiberarQuirofano($this->quirofanoService);
    }

    public function tearDown(): void
    {
        Mockery::close(); // Cerrar Mockery después de las pruebas
        parent::tearDown(); // Llamar al tearDown() de la clase padre
    }

    public function test_can_liberar_quirofano()
    {
        // ID de quirófano de prueba
        $quirofanoId = 1;

        // Definir expectativa: Simular la llamada al método liberarQuirofano del servicio de Quirofano
        $this->quirofanoService->shouldReceive('liberarQuirofano')
            ->with($quirofanoId)
            ->once()
            ->andReturn(true); // Simular que el quirófano fue liberado correctamente

        // Ejecutar el método que queremos probar en el caso de uso
        $result = $this->liberarQuirofano->execute($quirofanoId);

        // Verificar que el resultado es el esperado
        $this->assertTrue($result);
    }
}
