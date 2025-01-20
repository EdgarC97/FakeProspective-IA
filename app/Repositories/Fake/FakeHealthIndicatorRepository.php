<?php

namespace App\Repositories\Fake;

use App\Repositories\HealthIndicatorRepositoryInterface;
use Illuminate\Support\Collection;

class FakeHealthIndicatorRepository implements HealthIndicatorRepositoryInterface
{
    public function getHealthIndicators($userId, $startDate, $endDate)
    {
        // Generar datos falsos para pruebas
        return [
            'savings_ratio' => rand(5, 25) / 100, // Entre 5% y 25%
            'expense_trend' => rand(-10, 10) / 100, // Tendencia entre -10% y +10%
            'goal_completion_rate' => rand(30, 95) / 100, // Entre 30% y 95%
            'financial_health_score' => rand(50, 100), // Entre 50 y 100
            'monthly_savings' => rand(1000, 5000), // Entre 1000 y 5000
            'updated_at' => now()->toISOString()
        ];
    }
}
