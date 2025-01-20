<?php

namespace App\Repositories\Fake;

use App\Repositories\ExpenseRepositoryInterface;
use App\Models\Expense;

class FakeExpenseRepository implements ExpenseRepositoryInterface
{
    public function getExpenses($userId, $startDate, $endDate)
    {
        return Expense::where('user_id', $userId)
            ->where(function($query) use ($startDate, $endDate) {
                $query->whereBetween('start_date', [$startDate, $endDate])
                      ->orWhereBetween('end_date', [$startDate, $endDate]);
            })
            ->get();
    }
}
