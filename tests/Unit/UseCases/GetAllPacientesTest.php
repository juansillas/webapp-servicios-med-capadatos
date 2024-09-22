<?php

namespace Tests\Unit\UseCases;

use Tests\TestCase;
use App\Application\UseCases\GetAllPacientes;
use App\Application\Services\PacienteService;
use Mockery;

class GetAllPacientesTest extends TestCase
{
    protected $pacienteService;
    protected $getAllPacientes;

    public function setUp(): void
    {
        parent::setUp();

        // Crear un mock del servicio de Paciente
        $this->pacienteService = Mockery::mock(PacienteService::class);

        // Crear la instancia de GetAllPacientes inyectando el mock del servicio de Paciente
        $this->getAllPacientes = new GetAllPacientes($this->pacienteService);
    }

    public function tearDown(): void
    {
        Mockery::close(); // Cerrar Mockery después de las pruebas
        parent::tearDown(); // Llamar al tearDown() de la clase padre
    }

    public function test_can_get_all_pacientes()
    {
        // Datos de prueba simulados
        $pacientes = [
            (object) ['id' => 1, 'nombre' => 'Juan Pérez', 'estado' => 'Activo'],
            (object) ['id' => 2, 'nombre' => 'María Gómez', 'estado' => 'Activo']
        ];

        // Definir expectativa: Simular la llamada al método obtenerTodosLosPacientes del servicio de Paciente
        $this->pacienteService->shouldReceive('obtenerTodosLosPacientes')
            ->once()
            ->andReturn($pacientes); // Devolver los pacientes simulados

        // Ejecutar el método que queremos probar en el caso de uso
        $result = $this->getAllPacientes->execute();

        // Verificar que el resultado es el esperado
        $this->assertEquals($pacientes, $result);
    }
}
