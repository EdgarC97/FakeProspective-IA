<?php

namespace App\Services;

use App\Repositories\HealthIndicatorRepositoryInterface;
use Illuminate\Support\Facades\Log;

class HealthIndicatorService
{
    protected $repository;

    public function __construct(HealthIndicatorRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function processHealthIndicators($userId, $startDate, $endDate)
    {
        try {
            $indicators = $this->repository->getHealthIndicators($userId, $startDate, $endDate);

            // Aquí puedes agregar lógica adicional para procesar los indicadores
            // Por ejemplo, calcular ratios, tendencias, etc.

            Log::info("Processed health indicators for user {$userId}");
            return $indicators;
        } catch (\Exception $e) {
            Log::error("Error processing health indicators: " . $e->getMessage());
            return null;
        }
    }
}
