<?php

namespace Tests\Unit\UseCases;

use Tests\TestCase;
use App\Application\UseCases\AsignarCama;
use App\Application\Services\CamaService;
use Mockery;

class AsignarCamaTest extends TestCase
{
    protected $camaService;
    protected $asignarCama;

    public function setUp(): void
    {
        parent::setUp();

        // Crear un mock del servicio de Cama
        $this->camaService = Mockery::mock(CamaService::class);

        // Crear la instancia de AsignarCama inyectando el mock del servicio de Cama
        $this->asignarCama = new AsignarCama($this->camaService);
    }

    public function tearDown(): void
    {
        Mockery::close(); // Cerrar Mockery después de las pruebas
        parent::tearDown(); // Llamar al tearDown() de la clase padre
    }

    public function test_can_asignar_cama()
    {
        // Datos de prueba
        $data = [
            'paciente_id' => 1,
            'cama_id' => 1,
            'ubicacion' => 'Sala 1'
        ];

        // Definir expectativa: Simular la llamada al método asignarCama del servicio de Cama
        $this->camaService->shouldReceive('asignarCama')
            ->with($data)
            ->once()
            ->andReturn((object) ['id' => 1, 'estado' => 'asignada', 'ubicacion' => 'Sala 1']);

        // Ejecutar el método que queremos probar en el caso de uso
        $result = $this->asignarCama->execute($data);

        // Verificar que el resultado es el esperado
        $this->assertEquals((object) ['id' => 1, 'estado' => 'asignada', 'ubicacion' => 'Sala 1'], $result);
    }
}
