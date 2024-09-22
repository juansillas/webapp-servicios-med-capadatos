<?php

namespace Tests\Unit\UseCases;

use Tests\TestCase;
use App\Application\UseCases\GetConsultaById;
use App\Application\Services\ConsultaService;
use Mockery;

class GetConsultaByIdTest extends TestCase
{
    protected $consultaService;
    protected $getConsultaById;

    public function setUp(): void
    {
        parent::setUp();

        // Crear un mock del servicio de Consulta
        $this->consultaService = Mockery::mock(ConsultaService::class);

        // Crear la instancia de GetConsultaById inyectando el mock del servicio de Consulta
        $this->getConsultaById = new GetConsultaById($this->consultaService);
    }

    public function tearDown(): void
    {
        Mockery::close(); // Cerrar Mockery después de las pruebas
        parent::tearDown(); // Llamar al tearDown() de la clase padre
    }

    public function test_can_get_consulta_by_id()
    {
        // ID de prueba
        $consultaId = 1;

        // Consulta de prueba simulada
        $consulta = (object) ['id' => 1, 'paciente_id' => 1, 'medico_id' => 1, 'fecha' => '2024-09-21', 'diagnostico' => 'Dolor de cabeza'];

        // Definir expectativa: Simular la llamada al método obtenerConsultaPorId del servicio de Consulta
        $this->consultaService->shouldReceive('obtenerConsultaPorId')
            ->with($consultaId)
            ->once()
            ->andReturn($consulta); // Devolver la consulta simulada

        // Ejecutar el método que queremos probar en el caso de uso
        $result = $this->getConsultaById->execute($consultaId);

        // Verificar que el resultado es el esperado
        $this->assertEquals($consulta, $result);
    }
}
