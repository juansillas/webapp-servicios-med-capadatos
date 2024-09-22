<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Application\UseCases\AsignarCama;
use App\Application\UseCases\LiberarCama;
use App\Application\UseCases\GetCamaById;
use App\Application\UseCases\GetAllCamas;
use Mockery;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\JsonResponse;

class CamaControllerTest extends TestCase
{
    use RefreshDatabase;

    protected $asignarCama;
    protected $liberarCama;
    protected $getCamaById;
    protected $getAllCamas;

    public function setUp(): void
    {
        parent::setUp();

        // Crear mocks de los casos de uso
        $this->asignarCama = Mockery::mock(AsignarCama::class);
        $this->liberarCama = Mockery::mock(LiberarCama::class);
        $this->getCamaById = Mockery::mock(GetCamaById::class);
        $this->getAllCamas = Mockery::mock(GetAllCamas::class);

        // Inyectar los mocks en el contenedor de servicios
        $this->app->instance(AsignarCama::class, $this->asignarCama);
        $this->app->instance(LiberarCama::class, $this->liberarCama);
        $this->app->instance(GetCamaById::class, $this->getCamaById);
        $this->app->instance(GetAllCamas::class, $this->getAllCamas);
    }

    public function tearDown(): void
    {
        Mockery::close(); // Cerrar Mockery después de las pruebas
        parent::tearDown();
    }

    public function test_can_asignar_cama()
    {
        // Datos de prueba
        $data = [
            'numero_cama' => '101',
            'area' => 'Urgencias',
            'estado' => 'disponible'
        ];

        // Resultado esperado
        $cama = (object) $data;

        // Simular la ejecución del caso de uso
        $this->asignarCama->shouldReceive('execute')
            ->with($data)
            ->once()
            ->andReturn($cama);

        // Enviar la petición POST
        $response = $this->postJson('/api/camas/asignar', $data);

        // Verificar que la respuesta sea 201 y que los datos sean correctos
        $response->assertStatus(201)
                 ->assertJson((array) $cama);
    }

    public function test_can_liberar_cama()
    {
        // ID de cama de prueba
        $camaId = 1;

        // Simular la ejecución del caso de uso
        $this->liberarCama->shouldReceive('execute')
            ->with($camaId)
            ->once()
            ->andReturn(true);

        // Enviar la petición DELETE
        $response = $this->deleteJson("/api/camas/liberar/{$camaId}");

        // Verificar que la respuesta sea 200 y que el mensaje sea correcto
        $response->assertStatus(200)
                 ->assertJson(['message' => 'Cama liberada']);
    }

    public function test_can_get_cama_by_id()
    {
        // ID de cama de prueba
        $camaId = 1;

        // Resultado esperado
        $cama = (object) ['id' => $camaId, 'numero_cama' => '101', 'area' => 'Urgencias', 'estado' => 'disponible'];

        // Simular la ejecución del caso de uso
        $this->getCamaById->shouldReceive('execute')
            ->with($camaId)
            ->once()
            ->andReturn($cama);

        // Enviar la petición GET
        $response = $this->getJson("/api/camas/{$camaId}");

        // Verificar que la respuesta sea 200 y que los datos sean correctos
        $response->assertStatus(200)
                 ->assertJson((array) $cama);
    }

    public function test_can_get_all_camas()
    {
        // Resultado esperado
        $camas = [
            (object) ['id' => 1, 'numero_cama' => '101', 'area' => 'Urgencias', 'estado' => 'disponible'],
            (object) ['id' => 2, 'numero_cama' => '102', 'area' => 'Recuperación', 'estado' => 'ocupada']
        ];

        // Simular la ejecución del caso de uso
        $this->getAllCamas->shouldReceive('execute')
            ->once()
            ->andReturn($camas);

        // Enviar la petición GET
        $response = $this->getJson('/api/camas');

        // Verificar que la respuesta sea 200 y que los datos sean correctos
        $response->assertStatus(200)
                 ->assertJson((array) $camas);
    }
}
