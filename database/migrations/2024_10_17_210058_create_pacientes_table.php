<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pacientes', function (Blueprint $table) {
            $table->id(); // ID del paciente
            $table->string('nombre'); // Nombre del paciente
            $table->string('apellido'); // Apellido del paciente
            $table->date('fecha_nacimiento'); // Fecha de nacimiento
            $table->string('estado'); // Estado (por ejemplo, Activo, Inactivo)

            // Claves foráneas (si corresponde a otras tablas)
            $table->unsignedBigInteger('historial_medico_id')->nullable();
            $table->unsignedBigInteger('ubicacion_actual_id')->nullable();

            // Timestamps para created_at y updated_at
            $table->timestamps();

            // Claves foráneas
            $table->foreign('historial_medico_id')->references('id')->on('historiales_medicos')->onDelete('set null');
            $table->foreign('ubicacion_actual_id')->references('id')->on('ubicaciones_actuales')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pacientes');
    }
};
