<?php

namespace Tests\Unit\UseCases;

use Tests\TestCase;
use App\Application\UseCases\GetPacientesByEstado;
use App\Application\Services\PacienteService;
use Mockery;

class GetPacientesByEstadoTest extends TestCase
{
    protected $pacienteService;
    protected $getPacientesByEstado;

    public function setUp(): void
    {
        parent::setUp();

        // Crear un mock del servicio de Paciente
        $this->pacienteService = Mockery::mock(PacienteService::class);

        // Crear la instancia de GetPacientesByEstado inyectando el mock del servicio de Paciente
        $this->getPacientesByEstado = new GetPacientesByEstado($this->pacienteService);
    }

    public function tearDown(): void
    {
        Mockery::close(); // Cerrar Mockery después de las pruebas
        parent::tearDown(); // Llamar al tearDown() de la clase padre
    }

    public function test_can_get_pacientes_by_estado()
    {
        // Estado de prueba
        $estado = 'Activo';

        // Pacientes de prueba simulados
        $pacientes = [
            (object) ['id' => 1, 'nombre' => 'Juan Pérez', 'estado' => $estado],
            (object) ['id' => 2, 'nombre' => 'María Gómez', 'estado' => $estado]
        ];

        // Definir expectativa: Simular la llamada al método obtenerPacientesPorEstado del servicio de Paciente
        $this->pacienteService->shouldReceive('obtenerPacientesPorEstado')
            ->with($estado)
            ->once()
            ->andReturn($pacientes); // Devolver los pacientes simulados

        // Ejecutar el método que queremos probar en el caso de uso
        $result = $this->getPacientesByEstado->execute($estado);

        // Verificar que el resultado es el esperado
        $this->assertEquals($pacientes, $result);
    }
}
