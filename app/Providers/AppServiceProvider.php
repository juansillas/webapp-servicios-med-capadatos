<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

// Importa todas las interfaces y sus implementaciones
use App\Repositories\Contracts\PacienteRepositoryInterface;
use App\Repositories\Eloquent\PacienteRepository;

use App\Repositories\Contracts\HistorialMedicoRepositoryInterface;
use App\Repositories\Eloquent\HistorialMedicoRepository;

use App\Repositories\Contracts\UbicacionActualRepositoryInterface;
use App\Repositories\Eloquent\UbicacionActualRepository;

use App\Repositories\Contracts\PersonalMedicoRepositoryInterface;
use App\Repositories\Eloquent\PersonalMedicoRepository;

use App\Repositories\Contracts\TurnoActualRepositoryInterface;
use App\Repositories\Eloquent\TurnoActualRepository;

use App\Repositories\Contracts\CamaRepositoryInterface;
use App\Repositories\Eloquent\CamaRepository;

use App\Repositories\Contracts\QuirofanoRepositoryInterface;
use App\Repositories\Eloquent\QuirofanoRepository;

use App\Repositories\Contracts\ConsultaRepositoryInterface;
use App\Repositories\Eloquent\ConsultaRepository;

use App\Repositories\Contracts\EquipoMedicoRepositoryInterface;
use App\Repositories\Eloquent\EquipoMedicoRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // Vincula cada interfaz con su implementación
        $this->app->bind(PacienteRepositoryInterface::class, PacienteRepository::class);
        $this->app->bind(HistorialMedicoRepositoryInterface::class, HistorialMedicoRepository::class);
        $this->app->bind(UbicacionActualRepositoryInterface::class, UbicacionActualRepository::class);
        $this->app->bind(PersonalMedicoRepositoryInterface::class, PersonalMedicoRepository::class);
        $this->app->bind(TurnoActualRepositoryInterface::class, TurnoActualRepository::class);
        $this->app->bind(CamaRepositoryInterface::class, CamaRepository::class);
        $this->app->bind(QuirofanoRepositoryInterface::class, QuirofanoRepository::class);
        $this->app->bind(ConsultaRepositoryInterface::class, ConsultaRepository::class);
        $this->app->bind(EquipoMedicoRepositoryInterface::class, EquipoMedicoRepository::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Aquí puedes agregar cualquier otra configuración que necesites al arrancar la aplicación.
    }
}
