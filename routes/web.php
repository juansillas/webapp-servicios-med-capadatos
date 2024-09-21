<?php

// use App\Http\Controllers\PacienteController;
// use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::post('/pacientes', [PacienteController::class, 'store']); // Rutas para la creación de pacientes
// Route::get('/pacientes/{id}', [PacienteController::class, 'show']); // Rutas para mostrar pacientes

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Cache;

Route::get('/test-cache', function () {
    // Cachear un valor por 10 minutos
    Cache::put('clave', 'valor', 600);

    // Obtener el valor de la caché y mostrarlo
    $value = Cache::get('clave');

    return "El valor almacenado en caché es: " . $value;
});
