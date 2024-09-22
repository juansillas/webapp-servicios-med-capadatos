<?php

namespace Tests\Unit\UseCases;

use Tests\TestCase;
use App\Application\UseCases\DeletePaciente;
use App\Application\Services\PacienteService;
use Mockery;

class DeletePacienteTest extends TestCase
{
    protected $pacienteService;
    protected $deletePaciente;

    public function setUp(): void
    {
        parent::setUp();

        // Crear un mock del servicio de Paciente
        $this->pacienteService = Mockery::mock(PacienteService::class);

        // Crear la instancia de DeletePaciente inyectando el mock del servicio de Paciente
        $this->deletePaciente = new DeletePaciente($this->pacienteService);
    }

    public function tearDown(): void
    {
        Mockery::close(); // Cerrar Mockery después de las pruebas
        parent::tearDown(); // Llamar al tearDown() de la clase padre
    }

    public function test_can_delete_paciente()
    {
        // ID de prueba para eliminar un paciente
        $pacienteId = 1;

        // Definir expectativa: Simular la llamada al método eliminarPaciente del servicio de Paciente
        $this->pacienteService->shouldReceive('eliminarPaciente')
            ->with($pacienteId)
            ->once()
            ->andReturn(true); // Suponemos que devuelve true al eliminar correctamente

        // Ejecutar el método que queremos probar en el caso de uso
        $result = $this->deletePaciente->execute($pacienteId);

        // Verificar que el resultado es el esperado
        $this->assertTrue($result);
    }
}
