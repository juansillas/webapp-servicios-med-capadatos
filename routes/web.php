<?php

use App\Http\Controllers\PacienteController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::post('/pacientes', [PacienteController::class, 'store']); // Rutas para la creación de pacientes
Route::get('/pacientes/{id}', [PacienteController::class, 'show']); // Rutas para mostrar pacientes
