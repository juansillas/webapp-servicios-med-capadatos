<?php

namespace App\Repositories\Contracts;

interface QuirofanoRepositoryInterface extends BaseRepositoryInterface
{
    public function getAvailableQuirofanos();
    public function getQuirofanosByEstado($estado);
}
