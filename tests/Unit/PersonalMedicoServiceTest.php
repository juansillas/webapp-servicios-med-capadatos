<?php

namespace Tests\Unit\Services;

use Tests\TestCase;
use App\Services\PersonalMedicoService;
use App\Repositories\Contracts\PersonalMedicoRepositoryInterface;
use App\Repositories\Contracts\TurnoActualRepositoryInterface;
use Mockery;

class PersonalMedicoServiceTest extends TestCase
{
    protected $personalMedicoRepository;
    protected $turnoActualRepository;
    protected $personalMedicoService;

    public function setUp(): void
    {
        parent::setUp();

        // Crear mocks de los repositorios
        $this->personalMedicoRepository = Mockery::mock(PersonalMedicoRepositoryInterface::class);
        $this->turnoActualRepository = Mockery::mock(TurnoActualRepositoryInterface::class);

        // Crear la instancia de PersonalMedicoService inyectando los mocks
        $this->personalMedicoService = new PersonalMedicoService(
            $this->personalMedicoRepository,
            $this->turnoActualRepository
        );
    }

    public function tearDown(): void
    {
        Mockery::close(); // Cerrar Mockery después de las pruebas
        parent::tearDown(); // Llamar al tearDown() de la clase padre
    }

    public function test_can_get_medico_with_turnos()
    {
        // Datos de prueba: médico y sus turnos
        $medicoId = 1;
        $medico = (object) ['id' => 1, 'nombre' => 'Dr. Juan', 'especialidad' => 'Cardiología'];
        $turnos = [
            (object) ['id' => 1, 'fecha' => '2024-09-21', 'hora_inicio' => '08:00', 'hora_fin' => '16:00'],
            (object) ['id' => 2, 'fecha' => '2024-09-22', 'hora_inicio' => '16:00', 'hora_fin' => '00:00']
        ];

        // Definir expectativas: Simular las llamadas a los repositorios
        $this->personalMedicoRepository->shouldReceive('find')
            ->with($medicoId)
            ->once()
            ->andReturn($medico);

        $this->turnoActualRepository->shouldReceive('getTurnosByMedico')
            ->with($medicoId)
            ->once()
            ->andReturn($turnos);

        // Ejecutar el método que queremos probar
        $result = $this->personalMedicoService->obtenerMedicoConTurnos($medicoId);

        // Verificar que el resultado contiene el médico y sus turnos esperados
        $this->assertEquals($medico, $result['medico']);
        $this->assertEquals($turnos, $result['turnos']);
    }
}
