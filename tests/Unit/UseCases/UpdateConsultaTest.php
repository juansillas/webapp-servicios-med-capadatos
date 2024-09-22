<?php

namespace Tests\Unit\UseCases;

use Tests\TestCase;
use App\Application\UseCases\UpdateConsulta;
use App\Application\Services\ConsultaService;
use Mockery;

class UpdateConsultaTest extends TestCase
{
    protected $consultaService;
    protected $updateConsulta;

    public function setUp(): void
    {
        parent::setUp();

        // Crear un mock del servicio de Consulta
        $this->consultaService = Mockery::mock(ConsultaService::class);

        // Crear la instancia de UpdateConsulta inyectando el mock del servicio de Consulta
        $this->updateConsulta = new UpdateConsulta($this->consultaService);
    }

    public function tearDown(): void
    {
        Mockery::close(); // Cerrar Mockery después de las pruebas
        parent::tearDown(); // Llamar al tearDown() de la clase padre
    }

    public function test_can_update_consulta()
    {
        // ID de consulta de prueba
        $consultaId = 1;

        // Datos de actualización de la consulta
        $data = [
            'diagnostico' => 'Nueva condición',
            'tratamiento' => 'Nuevo tratamiento'
        ];

        // Consulta simulada después de la actualización
        $updatedConsulta = (object) [
            'id' => $consultaId,
            'diagnostico' => 'Nueva condición',
            'tratamiento' => 'Nuevo tratamiento'
        ];

        // Definir expectativa: Simular la llamada al método actualizarConsulta del servicio de Consulta
        $this->consultaService->shouldReceive('actualizarConsulta')
            ->with($consultaId, $data)
            ->once()
            ->andReturn($updatedConsulta); // Devolver la consulta actualizada simulada

        // Ejecutar el método que queremos probar en el caso de uso
        $result = $this->updateConsulta->execute($consultaId, $data);

        // Verificar que el resultado es el esperado
        $this->assertEquals($updatedConsulta, $result);
    }
}
