<?php

namespace App\Repositories\Contracts;

interface CamaRepositoryInterface extends BaseRepositoryInterface
{
    public function getAvailableCamas();
    public function getCamasByUbicacion($ubicacion);
}
