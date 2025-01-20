<?php

namespace App\Services;

use App\Repositories\ExpenseRepositoryInterface;
use App\Models\Expense;
use Illuminate\Support\Facades\Log;

class ExpenseService
{
    protected $repository;

    public function __construct(ExpenseRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function processExpenses($userId, $startDate, $endDate)
    {
        try {
            $expenses = $this->repository->getExpenses($userId, $startDate, $endDate);

            if ($expenses->isEmpty()) {
                Log::info("No expenses found for user {$userId} between {$startDate} and {$endDate}");
            } else {
                Log::info("Found " . $expenses->count() . " expenses for user {$userId}");
            }

            return $expenses;
        } catch (\Exception $e) {
            Log::error("Error processing expenses: " . $e->getMessage());
            return collect();
        }
    }
}
