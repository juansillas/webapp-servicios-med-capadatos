<?php

namespace App\Repositories\Eloquent;

use App\Models\Quirofano;
use App\Repositories\Contracts\QuirofanoRepositoryInterface;

class QuirofanoRepository extends BaseRepository implements QuirofanoRepositoryInterface
{
    public function __construct(Quirofano $model)
    {
        parent::__construct($model);
    }

    public function getAvailableQuirofanos()
    {
        return $this->model->where('estado', 'Disponible')->get();
    }

    public function getQuirofanosByEstado($estado)
    {
        return $this->model->where('estado', $estado)->get();
    }
}
