<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PacienteController;
use App\Http\Controllers\ConsultaController;
use App\Http\Controllers\PersonalMedicoController;
use App\Http\Controllers\CamaController;
use App\Http\Controllers\QuirofanoController;
use App\Http\Controllers\EquipoMedicoController;
use App\Http\Controllers\ReporteController;

// Rutas relacionadas con pacientes
Route::prefix('pacientes')->group(function () {
    Route::post('/', [PacienteController::class, 'store']); // Crear paciente
    Route::get('/', [PacienteController::class, 'index']); // Obtener todos los pacientes
    Route::get('/{id}', [PacienteController::class, 'show']); // Obtener un paciente por ID
    Route::put('/{id}', [PacienteController::class, 'update']); // Actualizar un paciente
    Route::delete('/{id}', [PacienteController::class, 'destroy']); // Eliminar un paciente
    Route::get('/estado/{estado}', [PacienteController::class, 'getByEstado']); // Obtener pacientes por estado
});

// Rutas relacionadas con consultas médicas
Route::prefix('consultas')->group(function () {
    Route::post('/', [ConsultaController::class, 'store']); // Crear consulta
    Route::get('/paciente/{pacienteId}', [ConsultaController::class, 'getByPaciente']); // Obtener consultas por paciente
    Route::get('/{id}', [ConsultaController::class, 'show']); // Obtener consulta por ID
    Route::put('/{id}', [ConsultaController::class, 'update']); // Actualizar consulta
    Route::delete('/{id}', [ConsultaController::class, 'destroy']); // Eliminar consulta
});

// Rutas relacionadas con personal médico
Route::prefix('personal-medico')->group(function () {
    Route::post('/', [PersonalMedicoController::class, 'store']); // Registrar nuevo personal médico
    Route::get('/', [PersonalMedicoController::class, 'index']); // Obtener todo el personal médico
    Route::get('/{id}', [PersonalMedicoController::class, 'show']); // Obtener personal médico por ID
    Route::put('/{id}', [PersonalMedicoController::class, 'update']); // Actualizar información de personal médico
    Route::delete('/{id}', [PersonalMedicoController::class, 'destroy']); // Eliminar personal médico
    Route::post('/asignar-turno', [PersonalMedicoController::class, 'assignTurno']); // Asignar turno al personal médico
});

// Rutas relacionadas con camas
Route::prefix('camas')->group(function () {
    Route::post('/asignar', [CamaController::class, 'asignar']); // Asignar cama
    Route::put('/liberar/{id}', [CamaController::class, 'liberar']); // Liberar cama
    Route::get('/{id}', [CamaController::class, 'show']); // Obtener detalles de una cama
    Route::get('/', [CamaController::class, 'index']); // Obtener todas las camas
});

// Rutas relacionadas con quirófanos
Route::prefix('quirofanos')->group(function () {
    Route::post('/asignar', [QuirofanoController::class, 'asignar']); // Asignar quirófano
    Route::put('/liberar/{id}', [QuirofanoController::class, 'liberar']); // Liberar quirófano
    Route::get('/{id}', [QuirofanoController::class, 'show']); // Obtener detalles de un quirófano
    Route::get('/', [QuirofanoController::class, 'index']); // Obtener todos los quirófanos
});

// Rutas relacionadas con equipos médicos
Route::prefix('equipos-medicos')->group(function () {
    Route::post('/asignar', [EquipoMedicoController::class, 'asignar']); // Asignar equipo médico
    Route::put('/liberar/{id}', [EquipoMedicoController::class, 'liberar']); // Liberar equipo médico
    Route::get('/{id}', [EquipoMedicoController::class, 'show']); // Obtener detalles de un equipo médico
    Route::get('/', [EquipoMedicoController::class, 'index']); // Obtener todos los equipos médicos
});

// Rutas relacionadas con reportes
Route::prefix('reportes')->group(function () {
    Route::post('/pacientes', [ReporteController::class, 'generarReportePacientes']); // Generar reporte de pacientes
    Route::post('/consultas', [ReporteController::class, 'generarReporteConsultas']); // Generar reporte de consultas
    Route::post('/personal-medico', [ReporteController::class, 'generarReportePersonalMedico']); // Generar reporte de personal médico
    Route::post('/uso-camas', [ReporteController::class, 'generarReporteUsoCamas']); // Generar reporte de uso de camas
    Route::post('/uso-quirofanos', [ReporteController::class, 'generarReporteUsoQuirofanos']); // Generar reporte de uso de quirófanos
    Route::post('/equipos-medicos', [ReporteController::class, 'generarReporteEquiposMedicos']); // Generar reporte de equipos médicos
});
