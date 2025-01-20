<?php

namespace App\Http\Controllers;

use App\Services\ExpenseService;
use App\Services\GoalService;
use App\Services\HealthIndicatorService;
use Illuminate\Http\Request;

class FinancialDataController extends Controller
{
    protected $expenseService;
    protected $goalService;
    protected $healthIndicatorService;

    public function __construct(
        ExpenseService $expenseService,
        GoalService $goalService,
        HealthIndicatorService $healthIndicatorService
    ) {
        $this->expenseService = $expenseService;
        $this->goalService = $goalService;
        $this->healthIndicatorService = $healthIndicatorService;
    }

    public function getData(Request $request, $userId)
    {
        $startDate = $request->input('start_date', now()->subMonth());
        $endDate = $request->input('end_date', now());

        $expenses = $this->expenseService->processExpenses($userId, $startDate, $endDate);
        $goals = $this->goalService->processGoals($userId);
        $healthIndicators = $this->healthIndicatorService->processHealthIndicators($userId, $startDate, $endDate);

        return response()->json([
            'expenses' => $expenses,
            'goals' => $goals,
            'health_indicators' => $healthIndicators
        ]);
    }
}
