<?php

namespace Tests\Unit\UseCases;

use Tests\TestCase;
use App\Application\UseCases\AssignTurnoPersonalMedico;
use App\Application\Services\PersonalMedicoService;  // Cambiar a PersonalMedicoService
use Mockery;

class AssignTurnoPersonalMedicoTest extends TestCase
{
    protected $personalMedicoService;  // Cambiar a PersonalMedicoService
    protected $assignTurnoPersonalMedico;

    public function setUp(): void
    {
        parent::setUp();

        // Crear un mock del servicio de PersonalMedico
        $this->personalMedicoService = Mockery::mock(PersonalMedicoService::class);  // Cambiar a PersonalMedicoService

        // Crear la instancia de AssignTurnoPersonalMedico inyectando el mock del servicio de PersonalMedico
        $this->assignTurnoPersonalMedico = new AssignTurnoPersonalMedico($this->personalMedicoService);
    }

    public function tearDown(): void
    {
        Mockery::close(); // Cerrar Mockery después de las pruebas
        parent::tearDown(); // Llamar al tearDown() de la clase padre
    }

    public function test_can_assign_turno_to_personal_medico()
    {
        // Datos de prueba para asignar un turno al personal médico
        $data = [
            'medico_id' => 1,
            'fecha' => '2024-09-21',
            'hora_inicio' => '08:00',
            'hora_fin' => '16:00'
        ];

        // Definir expectativa: Simular la llamada al método asignarTurno del servicio de PersonalMedico
        $this->personalMedicoService->shouldReceive('asignarTurno')
            ->with($data)
            ->once()
            ->andReturn((object) ['id' => 1, 'estado' => 'asignado', 'medico_id' => 1]);

        // Ejecutar el método que queremos probar en el caso de uso
        $result = $this->assignTurnoPersonalMedico->execute($data);

        // Verificar que el resultado es el esperado
        $this->assertEquals((object) ['id' => 1, 'estado' => 'asignado', 'medico_id' => 1], $result);
    }
}
