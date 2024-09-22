<?php

namespace Tests\Unit\UseCases;

use Tests\TestCase;
use App\Application\UseCases\DeleteConsulta;
use App\Application\Services\ConsultaService;
use Mockery;

class DeleteConsultaTest extends TestCase
{
    protected $consultaService;
    protected $deleteConsulta;

    public function setUp(): void
    {
        parent::setUp();

        // Crear un mock del servicio de Consulta
        $this->consultaService = Mockery::mock(ConsultaService::class);

        // Crear la instancia de DeleteConsulta inyectando el mock del servicio de Consulta
        $this->deleteConsulta = new DeleteConsulta($this->consultaService);
    }

    public function tearDown(): void
    {
        Mockery::close(); // Cerrar Mockery después de las pruebas
        parent::tearDown(); // Llamar al tearDown() de la clase padre
    }

    public function test_can_delete_consulta()
    {
        // ID de prueba para eliminar una consulta
        $consultaId = 1;

        // Definir expectativa: Simular la llamada al método eliminarConsulta del servicio de Consulta
        $this->consultaService->shouldReceive('eliminarConsulta')
            ->with($consultaId)
            ->once()
            ->andReturn(true); // Suponemos que devuelve true al eliminar correctamente

        // Ejecutar el método que queremos probar en el caso de uso
        $result = $this->deleteConsulta->execute($consultaId);

        // Verificar que el resultado es el esperado
        $this->assertTrue($result);
    }
}
