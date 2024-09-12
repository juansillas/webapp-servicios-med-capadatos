<?php

namespace Tests\Unit;

use App\Models\Paciente;
use App\Repositories\Eloquent\PacienteRepository;
use Tests\TestCase;

class PacienteRepositoryTest extends TestCase
{
    protected $pacienteRepository;

    protected function setUp(): void
    {
        parent::setUp();
        $this->pacienteRepository = new PacienteRepository(new Paciente());
    }

    public function testCreatePaciente()
    {
        $data = [
            'nombre' => 'John',
            'apellido' => 'Doe',
            'fecha_nacimiento' => '1990-01-01',
            'estado' => 'Activo'
        ];

        $paciente = $this->pacienteRepository->create($data);

        $this->assertEquals('John', $paciente->nombre);
        $this->assertEquals('Doe', $paciente->apellido);
    }
}
