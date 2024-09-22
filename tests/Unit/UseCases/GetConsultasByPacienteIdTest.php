<?php

namespace Tests\Unit\UseCases;

use Tests\TestCase;
use App\Application\UseCases\GetConsultasByPacienteId;
use App\Application\Services\ConsultaService;
use Mockery;

class GetConsultasByPacienteIdTest extends TestCase
{
    protected $consultaService;
    protected $getConsultasByPacienteId;

    public function setUp(): void
    {
        parent::setUp();

        // Crear un mock del servicio de Consulta
        $this->consultaService = Mockery::mock(ConsultaService::class);

        // Crear la instancia de GetConsultasByPacienteId inyectando el mock del servicio de Consulta
        $this->getConsultasByPacienteId = new GetConsultasByPacienteId($this->consultaService);
    }

    public function tearDown(): void
    {
        Mockery::close(); // Cerrar Mockery después de las pruebas
        parent::tearDown(); // Llamar al tearDown() de la clase padre
    }

    public function test_can_get_consultas_by_paciente_id()
    {
        // ID de paciente de prueba
        $pacienteId = 1;

        // Consultas de prueba simuladas
        $consultas = [
            (object) ['id' => 1, 'paciente_id' => $pacienteId, 'diagnostico' => 'Dolor de cabeza'],
            (object) ['id' => 2, 'paciente_id' => $pacienteId, 'diagnostico' => 'Fiebre']
        ];

        // Definir expectativa: Simular la llamada al método obtenerConsultasPorPaciente del servicio de Consulta
        $this->consultaService->shouldReceive('obtenerConsultasPorPaciente')
            ->with($pacienteId)
            ->once()
            ->andReturn($consultas); // Devolver las consultas simuladas

        // Ejecutar el método que queremos probar en el caso de uso
        $result = $this->getConsultasByPacienteId->execute($pacienteId);

        // Verificar que el resultado es el esperado
        $this->assertEquals($consultas, $result);
    }
}
