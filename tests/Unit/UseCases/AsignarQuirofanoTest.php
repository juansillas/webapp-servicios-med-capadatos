<?php

namespace Tests\Unit\UseCases;

use Tests\TestCase;
use App\Application\UseCases\AsignarQuirofano;
use App\Application\Services\QuirofanoService;
use Mockery;

class AsignarQuirofanoTest extends TestCase
{
    protected $quirofanoService;
    protected $asignarQuirofano;

    public function setUp(): void
    {
        parent::setUp();

        // Crear un mock del servicio de Quirofano
        $this->quirofanoService = Mockery::mock(QuirofanoService::class);

        // Crear la instancia de AsignarQuirofano inyectando el mock del servicio de Quirofano
        $this->asignarQuirofano = new AsignarQuirofano($this->quirofanoService);
    }

    public function tearDown(): void
    {
        Mockery::close(); // Cerrar Mockery después de las pruebas
        parent::tearDown(); // Llamar al tearDown() de la clase padre
    }

    public function test_can_asignar_quirofano()
    {
        // Datos de prueba para asignar quirófano
        $data = [
            'paciente_id' => 1,
            'quirofano_id' => 1,
            'fecha' => '2024-09-21',
            'hora' => '08:00'
        ];

        // Definir expectativa: Simular la llamada al método asignarQuirofano del servicio de Quirofano
        $this->quirofanoService->shouldReceive('asignarQuirofano')
            ->with($data)
            ->once()
            ->andReturn((object) ['id' => 1, 'estado' => 'asignado', 'quirofano_id' => 1]);

        // Ejecutar el método que queremos probar en el caso de uso
        $result = $this->asignarQuirofano->execute($data);

        // Verificar que el resultado es el esperado
        $this->assertEquals((object) ['id' => 1, 'estado' => 'asignado', 'quirofano_id' => 1], $result);
    }
}
