<?php

namespace Tests\Unit\Services;

use Tests\TestCase;
use App\Services\TurnoActualService;
use App\Repositories\Contracts\TurnoActualRepositoryInterface;
use Mockery;

class TurnoActualServiceTest extends TestCase
{
    protected $turnoActualRepository;
    protected $turnoActualService;

    public function setUp(): void
    {
        parent::setUp();

        // Crear mock del repositorio de TurnoActual
        $this->turnoActualRepository = Mockery::mock(TurnoActualRepositoryInterface::class);

        // Crear la instancia de TurnoActualService inyectando el mock
        $this->turnoActualService = new TurnoActualService($this->turnoActualRepository);
    }

    public function tearDown(): void
    {
        Mockery::close(); // Cerrar Mockery después de las pruebas
        parent::tearDown(); // Llamar al tearDown() de la clase padre
    }

    public function test_can_get_turnos_by_medico_id()
    {
        // Datos de prueba: turnos por médico
        $medicoId = 1;
        $turnos = [
            (object) ['id' => 1, 'medico_id' => 1, 'fecha' => '2024-09-21', 'hora_inicio' => '08:00', 'hora_fin' => '16:00'],
            (object) ['id' => 2, 'medico_id' => 1, 'fecha' => '2024-09-22', 'hora_inicio' => '16:00', 'hora_fin' => '00:00']
        ];

        // Definir expectativa: Simular la llamada al repositorio
        $this->turnoActualRepository->shouldReceive('getTurnosByMedico')
            ->with($medicoId)
            ->once()
            ->andReturn($turnos);

        // Ejecutar el método que queremos probar
        $result = $this->turnoActualService->obtenerTurnosPorMedico($medicoId);

        // Verificar que el resultado contiene los turnos esperados
        $this->assertEquals($turnos, $result);
    }

    public function test_can_get_turnos_by_fecha()
    {
        // Datos de prueba: turnos por fecha
        $fecha = '2024-09-21';
        $turnos = [
            (object) ['id' => 1, 'fecha' => '2024-09-21', 'medico_id' => 1, 'hora_inicio' => '08:00', 'hora_fin' => '16:00'],
            (object) ['id' => 2, 'fecha' => '2024-09-21', 'medico_id' => 2, 'hora_inicio' => '16:00', 'hora_fin' => '00:00']
        ];

        // Definir expectativa: Simular la llamada al repositorio
        $this->turnoActualRepository->shouldReceive('getTurnosByFecha')
            ->with($fecha)
            ->once()
            ->andReturn($turnos);

        // Ejecutar el método que queremos probar
        $result = $this->turnoActualService->obtenerTurnosPorFecha($fecha);

        // Verificar que el resultado contiene los turnos esperados
        $this->assertEquals($turnos, $result);
    }
}
