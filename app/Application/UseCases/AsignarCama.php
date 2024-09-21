<?php
namespace App\Application\UseCases;

use App\Application\Services\CamaService;

class AsignarCama
{
    protected $camaService;

    public function __construct(CamaService $camaService)
    {
        $this->camaService = $camaService;
    }

    public function execute(array $data)
    {
        return $this->camaService->asignarCama($data);
    }
}
