<?php

namespace App\Repositories\Fake;

use App\Repositories\GoalRepositoryInterface;

class FakeGoalRepository implements GoalRepositoryInterface
{
    public function getGoals($userId)
    {
        // Generate some fake goals
        return [
            [
                'id' => 1,
                'user_id' => $userId,
                'type' => 'Savings',
                'targetAmount' => 10000.00,
                'startDate' => now()->subMonth(),
                'targetDate' => now()->addYear(),
                'status' => 'In Progress',
                'currentProgress' => 2000.00
            ],
            // Add more fake goals...
        ];
    }
}
