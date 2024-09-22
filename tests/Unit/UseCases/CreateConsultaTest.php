<?php

namespace Tests\Unit\UseCases;

use Tests\TestCase;
use App\Application\UseCases\CreateConsulta;
use App\Application\Services\ConsultaService;
use Mockery;

class CreateConsultaTest extends TestCase
{
    protected $consultaService;
    protected $createConsulta;

    public function setUp(): void
    {
        parent::setUp();

        // Crear un mock del servicio de Consulta
        $this->consultaService = Mockery::mock(ConsultaService::class);

        // Crear la instancia de CreateConsulta inyectando el mock del servicio de Consulta
        $this->createConsulta = new CreateConsulta($this->consultaService);
    }

    public function tearDown(): void
    {
        Mockery::close(); // Cerrar Mockery después de las pruebas
        parent::tearDown(); // Llamar al tearDown() de la clase padre
    }

    public function test_can_create_consulta()
    {
        // Datos de prueba para crear una consulta
        $data = [
            'paciente_id' => 1,
            'medico_id' => 1,
            'fecha' => '2024-09-21',
            'diagnostico' => 'Dolor de cabeza',
            'tratamiento' => 'Paracetamol'
        ];

        // Definir expectativa: Simular la llamada al método crearConsulta del servicio de Consulta
        $this->consultaService->shouldReceive('crearConsulta')
            ->with($data)
            ->once()
            ->andReturn((object) ['id' => 1, 'paciente_id' => 1, 'medico_id' => 1, 'estado' => 'creada']);

        // Ejecutar el método que queremos probar en el caso de uso
        $result = $this->createConsulta->execute($data);

        // Verificar que el resultado es el esperado
        $this->assertEquals((object) ['id' => 1, 'paciente_id' => 1, 'medico_id' => 1, 'estado' => 'creada'], $result);
    }
}
