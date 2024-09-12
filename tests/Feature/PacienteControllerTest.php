<?php

namespace Tests\Feature;

use Tests\TestCase;

class PacienteControllerTest extends TestCase
{
    public function testCreatePaciente()
    {
        $response = $this->post('/api/pacientes', [
            'nombre' => 'John',
            'apellido' => 'Doe',
            'fecha_nacimiento' => '1990-01-01',
            'estado' => 'Activo'
        ]);

        $response->assertStatus(201);
    }
}
