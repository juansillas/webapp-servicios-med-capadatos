<?php

namespace App\Repositories\Eloquent;

use App\Models\HistorialMedico;
use App\Repositories\Contracts\HistorialMedicoRepositoryInterface;

class HistorialMedicoRepository implements HistorialMedicoRepositoryInterface
{
    protected $model;

    public function __construct(HistorialMedico $model)
    {
        $this->model = $model;
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }
}
