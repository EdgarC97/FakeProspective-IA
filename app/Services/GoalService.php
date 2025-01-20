<?php

namespace App\Services;

use App\Models\Goal;
use App\Repositories\GoalRepositoryInterface;
use Illuminate\Support\Facades\Log;

class GoalService
{
    protected $repository;

    public function __construct(GoalRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function processGoals($userId)
    {
        try {
            $goalsData = $this->repository->getGoals($userId);

            if (is_null($goalsData) || !is_array($goalsData)) {
                Log::warning("No goal data returned for user {$userId}");
                return collect();
            }

            foreach ($goalsData as $goalData) {
                Goal::updateOrCreate(
                    ['user_id' => $userId, 'id' => $goalData['id']],
                    [
                        'type' => $goalData['type'],
                        'target_amount' => $goalData['targetAmount'],
                        'start_date' => $goalData['startDate'],
                        'target_date' => $goalData['targetDate'],
                        'status' => $goalData['status'],
                        'current_progress' => $goalData['currentProgress']
                    ]
                );
            }

            return Goal::where('user_id', $userId)->get();
        } catch (\Exception $e) {
            Log::error("Error processing goals for user {$userId}: " . $e->getMessage());
            return collect();
        }
    }
}
