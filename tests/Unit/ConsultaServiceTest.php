<?php

namespace Tests\Unit\Services;

use Tests\TestCase;
use App\Application\Services\ConsultaService;
use App\Repositories\Contracts\ConsultaRepositoryInterface;
use Mockery;

class ConsultaServiceTest extends TestCase
{
    protected $consultaRepository;
    protected $consultaService;

    public function setUp(): void
    {
        parent::setUp();

        // Crear mock del repositorio de Consulta
        $this->consultaRepository = Mockery::mock(ConsultaRepositoryInterface::class);

        // Crear la instancia de ConsultaService inyectando el mock
        $this->consultaService = new ConsultaService($this->consultaRepository);
    }

    public function tearDown(): void
    {
        Mockery::close(); // Cerrar Mockery después de las pruebas
        parent::tearDown(); // Llamar al tearDown() de la clase padre
    }

    public function test_can_get_consultas_by_paciente_id()
    {
        // Datos de prueba: consultas del paciente
        $pacienteId = 1;
        $consultas = [
            (object) ['id' => 1, 'paciente_id' => 1, 'motivo' => 'Consulta general'],
            (object) ['id' => 2, 'paciente_id' => 1, 'motivo' => 'Chequeo anual']
        ];

        // Definir expectativa: Simular la llamada al repositorio
        $this->consultaRepository->shouldReceive('getByPacienteId')
            ->with($pacienteId)
            ->once()
            ->andReturn($consultas);

        // Ejecutar el método que queremos probar
        $result = $this->consultaService->obtenerConsultasPorPaciente($pacienteId);

        // Verificar que el resultado contiene las consultas esperadas
        $this->assertEquals($consultas, $result);
    }

    public function test_can_get_consultas_by_medico_id()
    {
        // Datos de prueba: consultas del médico
        $medicoId = 2;
        $consultas = [
            (object) ['id' => 1, 'medico_id' => 2, 'motivo' => 'Consulta especializada'],
            (object) ['id' => 2, 'medico_id' => 2, 'motivo' => 'Cirugía menor']
        ];

        // Definir expectativa: Simular la llamada al repositorio
        $this->consultaRepository->shouldReceive('getByMedicoId')
            ->with($medicoId)
            ->once()
            ->andReturn($consultas);

        // Ejecutar el método que queremos probar
        $result = $this->consultaService->obtenerConsultasPorMedico($medicoId);

        // Verificar que el resultado contiene las consultas esperadas
        $this->assertEquals($consultas, $result);
    }

    public function test_can_get_consultas_by_fecha()
    {
        // Datos de prueba: consultas por fecha
        $fecha = '2024-09-21';
        $consultas = [
            (object) ['id' => 1, 'fecha' => '2024-09-21', 'motivo' => 'Consulta dental'],
            (object) ['id' => 2, 'fecha' => '2024-09-21', 'motivo' => 'Chequeo general']
        ];

        // Definir expectativa: Simular la llamada al repositorio
        $this->consultaRepository->shouldReceive('getByFecha')
            ->with($fecha)
            ->once()
            ->andReturn($consultas);

        // Ejecutar el método que queremos probar
        $result = $this->consultaService->obtenerConsultasPorFecha($fecha);

        // Verificar que el resultado contiene las consultas esperadas
        $this->assertEquals($consultas, $result);
    }
}
