<?php

namespace App\Repositories\Api;

use App\Repositories\HealthIndicatorRepositoryInterface;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ApiHealthIndicatorRepository implements HealthIndicatorRepositoryInterface
{
    public function getHealthIndicators($userId, $startDate, $endDate)
    {
        try {
            $response = Http::get(config('api.health_indicators_url'), [
                'user_id' => $userId,
                'start_date' => $startDate,
                'end_date' => $endDate
            ]);

            if ($response->successful()) {
                return $response->json();
            }

            Log::error("Failed to fetch health indicators from API", [
                'status' => $response->status(),
                'response' => $response->body()
            ]);

            return null;
        } catch (\Exception $e) {
            Log::error("Error fetching health indicators: " . $e->getMessage());
            return null;
        }
    }
}
