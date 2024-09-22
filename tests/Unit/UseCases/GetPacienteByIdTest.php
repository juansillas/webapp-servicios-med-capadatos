<?php

namespace Tests\Unit\UseCases;

use Tests\TestCase;
use App\Application\UseCases\GetPacienteById;
use App\Application\Services\PacienteService;
use Mockery;

class GetPacienteByIdTest extends TestCase
{
    protected $pacienteService;
    protected $getPacienteById;

    public function setUp(): void
    {
        parent::setUp();

        // Crear un mock del servicio de Paciente
        $this->pacienteService = Mockery::mock(PacienteService::class);

        // Crear la instancia de GetPacienteById inyectando el mock del servicio de Paciente
        $this->getPacienteById = new GetPacienteById($this->pacienteService);
    }

    public function tearDown(): void
    {
        Mockery::close(); // Cerrar Mockery después de las pruebas
        parent::tearDown(); // Llamar al tearDown() de la clase padre
    }

    public function test_can_get_paciente_by_id()
    {
        // ID de prueba
        $pacienteId = 1;

        // Paciente de prueba simulado
        $paciente = (object) ['id' => $pacienteId, 'nombre' => 'Juan Pérez', 'estado' => 'Activo'];

        // Definir expectativa: Simular la llamada al método obtenerPacientePorId del servicio de Paciente
        $this->pacienteService->shouldReceive('obtenerPacientePorId')
            ->with($pacienteId)
            ->once()
            ->andReturn($paciente); // Devolver el paciente simulado

        // Ejecutar el método que queremos probar en el caso de uso
        $result = $this->getPacienteById->execute($pacienteId);

        // Verificar que el resultado es el esperado
        $this->assertEquals($paciente, $result);
    }
}
