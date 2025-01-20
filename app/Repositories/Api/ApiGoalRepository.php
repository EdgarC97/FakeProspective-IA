<?php

namespace App\Repositories\Api;

use App\Repositories\GoalRepositoryInterface;
use Illuminate\Support\Facades\Http;

class ApiGoalRepository implements GoalRepositoryInterface
{
    public function getGoals($userId)
    {
        $response = Http::get(config('api.goals_url') . "/{$userId}/summary");

        if ($response->successful()) {
            return $response->json();
        }

        throw new \Exception('Failed to fetch goals from API');
    }
}
