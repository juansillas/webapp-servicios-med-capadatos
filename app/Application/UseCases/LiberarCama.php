<?php
namespace App\Application\UseCases;

use App\Application\Services\CamaService;

class LiberarCama
{
    protected $camaService;

    public function __construct(CamaService $camaService)
    {
        $this->camaService = $camaService;
    }

    public function execute($id)
    {
        return $this->camaService->liberarCama($id);
    }
}
