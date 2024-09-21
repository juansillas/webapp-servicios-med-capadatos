<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Application\UseCases\AsignarCama;
use App\Application\UseCases\LiberarCama;
use App\Application\UseCases\GetCamaById;
use App\Application\UseCases\GetAllCamas;
use Mockery;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CamaControllerTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    protected $asignarCama;
    protected $liberarCama;
    protected $getCamaById;
    protected $getAllCamas;

    public function setUp(): void
    {
        parent::setUp();

        // Crear mocks para los casos de uso
        $this->asignarCama = Mockery::mock(AsignarCama::class);
        $this->liberarCama = Mockery::mock(LiberarCama::class);
        $this->getCamaById = Mockery::mock(GetCamaById::class);
        $this->getAllCamas = Mockery::mock(GetAllCamas::class);

        // Inyectar los mocks en el contenedor de Laravel
        $this->app->instance(AsignarCama::class, $this->asignarCama);
        $this->app->instance(LiberarCama::class, $this->liberarCama);
        $this->app->instance(GetCamaById::class, $this->getCamaById);
        $this->app->instance(GetAllCamas::class, $this->getAllCamas);
    }

    public function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }

    public function test_can_asignar_cama()
    {
        // Datos de prueba para asignar cama
        $data = ['paciente_id' => 1, 'cama_id' => 1, 'ubicacion' => 'Sala 1'];

        // Definir expectativa del caso de uso
        $this->asignarCama->shouldReceive('execute')
            ->with($data)
            ->once()
            ->andReturn((object) ['id' => 1, 'estado' => 'asignada']);

        // Enviar solicitud POST para asignar cama
        $response = $this->postJson('/api/camas/asignar', $data);

        // Verificar que la respuesta sea correcta
        $response->assertStatus(201)
            ->assertJson(['id' => 1, 'estado' => 'asignada']);
    }

    public function test_can_liberar_cama()
    {
        // Definir expectativa del caso de uso
        $this->liberarCama->shouldReceive('execute')
            ->with(1)
            ->once();

        // Enviar solicitud DELETE para liberar cama
        $response = $this->deleteJson('/api/camas/liberar/1');

        // Verificar que la respuesta sea correcta
        $response->assertStatus(200)
            ->assertJson(['message' => 'Cama liberada']);
    }

    public function test_can_show_cama()
    {
        // Datos de prueba para obtener una cama por ID
        $cama = (object) ['id' => 1, 'estado' => 'ocupada', 'ubicacion' => 'Sala 1'];

        // Definir expectativa del caso de uso
        $this->getCamaById->shouldReceive('execute')
            ->with(1)
            ->once()
            ->andReturn($cama);

        // Enviar solicitud GET para obtener los detalles de una cama
        $response = $this->getJson('/api/camas/1');

        // Verificar que la respuesta sea correcta
        $response->assertStatus(200)
            ->assertJson(['id' => 1, 'estado' => 'ocupada', 'ubicacion' => 'Sala 1']);
    }

    public function test_can_get_all_camas()
    {
        // Datos de prueba para obtener todas las camas
        $camas = [
            (object) ['id' => 1, 'estado' => 'ocupada'],
            (object) ['id' => 2, 'estado' => 'disponible']
        ];

        // Definir expectativa del caso de uso
        $this->getAllCamas->shouldReceive('execute')
            ->once()
            ->andReturn($camas);

        // Enviar solicitud GET para obtener todas las camas
        $response = $this->getJson('/api/camas');

        // Verificar que la respuesta sea correcta
        $response->assertStatus(200)
            ->assertJson([
                ['id' => 1, 'estado' => 'ocupada'],
                ['id' => 2, 'estado' => 'disponible']
            ]);
    }
}
