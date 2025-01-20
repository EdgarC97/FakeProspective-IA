<?php

namespace App\Http\Controllers;

use App\Services\ExpenseService;
use App\Services\GoalService;
use Illuminate\Http\Request;

class FinancialDataController extends Controller
{
    protected $expenseService;
    protected $goalService;

    public function __construct(ExpenseService $expenseService, GoalService $goalService)
    {
        $this->expenseService = $expenseService;
        $this->goalService = $goalService;
    }

    public function getData(Request $request, $userId)
    {
        $startDate = $request->input('start_date', now()->subMonths(3)->toDateString());
        $endDate = $request->input('end_date', now()->toDateString());

        $expenses = $this->expenseService->processExpenses($userId, $startDate, $endDate);
        $goals = $this->goalService->processGoals($userId);

        return response()->json([
            'expenses' => $expenses,
            'goals' => $goals
        ]);
    }
}
