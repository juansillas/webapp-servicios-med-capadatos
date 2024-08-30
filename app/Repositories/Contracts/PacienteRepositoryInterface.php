<?php


namespace App\Repositories\Contracts;

interface PacienteRepositoryInterface extends BaseRepositoryInterface
{
    public function findByNombreApellido($nombre, $apellido);
    public function findByUbicacionActual($ubicacionActualId);
    public function getPacientesByEstado($estado);
}
