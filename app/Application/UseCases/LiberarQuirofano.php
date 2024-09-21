<?php
namespace App\Application\UseCases;

use App\Application\Services\QuirofanoService;

class LiberarQuirofano
{
    protected $quirofanoService;

    public function __construct(QuirofanoService $quirofanoService)
    {
        $this->quirofanoService = $quirofanoService;
    }

    public function execute($id)
    {
        return $this->quirofanoService->liberarQuirofano($id);
    }
}
