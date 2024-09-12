<?php

use App\Http\Controllers\PacienteController;
use Illuminate\Support\Facades\Route;

Route::post('/pacientes', [PacienteController::class, 'store']); // Ruta para crear un paciente en la API
Route::get('/pacientes/{id}', [PacienteController::class, 'show']); // Ruta para obtener un paciente en formato JSON
