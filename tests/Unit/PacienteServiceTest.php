<?php

namespace Tests\Unit\Services;

use Tests\TestCase;
use App\Services\PacienteService;
use App\Repositories\Contracts\PacienteRepositoryInterface;
use App\Repositories\Contracts\HistorialMedicoRepositoryInterface;
use App\Repositories\Contracts\UbicacionActualRepositoryInterface;
use App\Repositories\Contracts\ConsultaRepositoryInterface;
use Mockery;

class PacienteServiceTest extends TestCase
{
    protected $pacienteRepository;
    protected $historialMedicoRepository;
    protected $ubicacionActualRepository;
    protected $consultaRepository;
    protected $pacienteService;

    public function setUp(): void
    {
        parent::setUp();

        // Crear mocks de los repositorios
        $this->pacienteRepository = Mockery::mock(PacienteRepositoryInterface::class);
        $this->historialMedicoRepository = Mockery::mock(HistorialMedicoRepositoryInterface::class);
        $this->ubicacionActualRepository = Mockery::mock(UbicacionActualRepositoryInterface::class);
        $this->consultaRepository = Mockery::mock(ConsultaRepositoryInterface::class);

        // Crear la instancia de PacienteService inyectando los mocks
        $this->pacienteService = new PacienteService(
            $this->pacienteRepository,
            $this->historialMedicoRepository,
            $this->ubicacionActualRepository,
            $this->consultaRepository
        );
    }

    public function tearDown(): void
    {
        Mockery::close(); // Cerrar Mockery después de las pruebas
        parent::tearDown(); // Llamar al tearDown() de la clase padre para limpiar bien
    }

    public function test_can_get_paciente_with_details()
    {
        // Datos de prueba
        $pacienteId = 1;
        $paciente = (object) ['id' => 1, 'nombre' => 'Juan', 'apellido' => 'Pérez'];
        $historial = [(object) ['id' => 1, 'detalle' => 'Consulta médica']];
        $ubicacion = (object) ['id' => 1, 'ubicacion' => 'Habitación 101'];
        $consultas = [(object) ['id' => 1, 'motivo' => 'Dolor de cabeza']];

        // Definir expectativas: Simular las llamadas a los repositorios
        $this->pacienteRepository->shouldReceive('find')
            ->with($pacienteId)
            ->once()
            ->andReturn($paciente);

        $this->historialMedicoRepository->shouldReceive('getByPacienteId')
            ->with($pacienteId)
            ->once()
            ->andReturn($historial);

        $this->ubicacionActualRepository->shouldReceive('getByPacienteId')
            ->with($pacienteId)
            ->once()
            ->andReturn($ubicacion);

        $this->consultaRepository->shouldReceive('getByPacienteId')
            ->with($pacienteId)
            ->once()
            ->andReturn($consultas);

        // Ejecutar el método que queremos probar
        $result = $this->pacienteService->obtenerPacienteConDetalles($pacienteId);

        // Verificar que el resultado contiene los datos esperados
        $this->assertEquals($paciente, $result['paciente']);
        $this->assertEquals($historial, $result['historial']);
        $this->assertEquals($ubicacion, $result['ubicacion']);
        $this->assertEquals($consultas, $result['consultas']);
    }
}
