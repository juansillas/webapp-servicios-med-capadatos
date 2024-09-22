<?php

namespace Tests\Unit\UseCases;

use Tests\TestCase;
use App\Application\UseCases\RegisterPaciente;
use App\Application\Services\PacienteService;
use Mockery;

class RegisterPacienteTest extends TestCase
{
    protected $pacienteService;
    protected $registerPaciente;

    public function setUp(): void
    {
        parent::setUp();

        // Crear un mock del servicio de Paciente
        $this->pacienteService = Mockery::mock(PacienteService::class);

        // Crear la instancia de RegisterPaciente inyectando el mock del servicio de Paciente
        $this->registerPaciente = new RegisterPaciente($this->pacienteService);
    }

    public function tearDown(): void
    {
        Mockery::close(); // Cerrar Mockery después de las pruebas
        parent::tearDown(); // Llamar al tearDown() de la clase padre
    }

    public function test_can_register_paciente()
    {
        // Datos de paciente de prueba
        $data = [
            'nombre' => 'Juan',
            'apellido' => 'Pérez',
            'fecha_nacimiento' => '1990-01-01',
            'estado' => 'Activo'
        ];

        // Paciente simulado que se creará
        $paciente = (object) ['id' => 1, 'nombre' => 'Juan', 'apellido' => 'Pérez', 'estado' => 'Activo'];

        // Definir expectativa: Simular la llamada al método crearPaciente del servicio de Paciente
        $this->pacienteService->shouldReceive('crearPaciente')
            ->with($data)
            ->once()
            ->andReturn($paciente); // Devolver el paciente simulado

        // Ejecutar el método que queremos probar en el caso de uso
        $result = $this->registerPaciente->execute($data);

        // Verificar que el resultado es el esperado
        $this->assertEquals($paciente, $result);
    }
}
