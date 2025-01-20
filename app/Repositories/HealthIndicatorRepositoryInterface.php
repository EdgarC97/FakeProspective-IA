<?php

namespace App\Repositories;

interface HealthIndicatorRepositoryInterface
{
    public function getHealthIndicators($userId, $startDate, $endDate);
}
