<?php

namespace Tests\Unit\UseCases;

use Tests\TestCase;
use App\Application\UseCases\RegisterPersonalMedico;
use App\Application\Services\PersonalMedicoService;
use Mockery;

class RegisterPersonalMedicoTest extends TestCase
{
    protected $personalMedicoService;
    protected $registerPersonalMedico;

    public function setUp(): void
    {
        parent::setUp();

        // Crear un mock del servicio de Personal Médico
        $this->personalMedicoService = Mockery::mock(PersonalMedicoService::class);

        // Crear la instancia de RegisterPersonalMedico inyectando el mock del servicio de Personal Médico
        $this->registerPersonalMedico = new RegisterPersonalMedico($this->personalMedicoService);
    }

    public function tearDown(): void
    {
        Mockery::close(); // Cerrar Mockery después de las pruebas
        parent::tearDown(); // Llamar al tearDown() de la clase padre
    }

    public function test_can_register_personal_medico()
    {
        // Datos de personal médico de prueba
        $data = [
            'nombre' => 'Dr. Carlos',
            'apellido' => 'Gómez',
            'especialidad' => 'Cardiología',
            'estado' => 'Activo'
        ];

        // Personal médico simulado que se creará
        $personalMedico = (object) [
            'id' => 1,
            'nombre' => 'Dr. Carlos',
            'apellido' => 'Gómez',
            'especialidad' => 'Cardiología',
            'estado' => 'Activo'
        ];

        // Definir expectativa: Simular la llamada al método registrarPersonalMedico del servicio de Personal Médico
        $this->personalMedicoService->shouldReceive('registrarPersonalMedico')
            ->with($data)
            ->once()
            ->andReturn($personalMedico); // Devolver el personal médico simulado

        // Ejecutar el método que queremos probar en el caso de uso
        $result = $this->registerPersonalMedico->execute($data);

        // Verificar que el resultado es el esperado
        $this->assertEquals($personalMedico, $result);
    }
}
