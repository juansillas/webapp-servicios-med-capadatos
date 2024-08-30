<?php

namespace App\Repositories\Eloquent;

use App\Models\Cama;
use App\Repositories\Contracts\CamaRepositoryInterface;

class CamaRepository extends BaseRepository implements CamaRepositoryInterface
{
    public function __construct(Cama $model)
    {
        parent::__construct($model);
    }

    public function getAvailableCamas()
    {
        return $this->model->where('estado', 'Disponible')->get();
    }

    public function getCamasByUbicacion($ubicacion)
    {
        return $this->model->where('ubicacion', $ubicacion)->get();
    }
}
