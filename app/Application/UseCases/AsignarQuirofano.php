<?php
namespace App\Application\UseCases;

use App\Application\Services\QuirofanoService;

class AsignarQuirofano
{
    protected $quirofanoService;

    public function __construct(QuirofanoService $quirofanoService)
    {
        $this->quirofanoService = $quirofanoService;
    }

    public function execute(array $data)
    {
        return $this->quirofanoService->asignarQuirofano($data);
    }
}
