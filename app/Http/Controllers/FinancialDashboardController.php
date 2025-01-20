<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\ExpenseService;
use App\Services\GoalService;
use Illuminate\Http\Request;

class FinancialDashboardController extends Controller
{
    protected $expenseService;
    protected $goalService;

    public function __construct(ExpenseService $expenseService, GoalService $goalService)
    {
        $this->expenseService = $expenseService;
        $this->goalService = $goalService;
    }

    public function index(Request $request)
    {
        $startDate = $request->input('start_date', now()->subMonths(3)->startOfDay()->toDateString());
        $endDate = $request->input('end_date', now()->endOfDay()->toDateString());

        $users = User::all()->map(function ($user) use ($startDate, $endDate) {
            $expenses = $this->expenseService->processExpenses($user->id, $startDate, $endDate);
            $goals = $this->goalService->processGoals($user->id);
            return [
                'user' => $user,
                'expenses' => $expenses,
                'goals' => $goals,
            ];
        });

        return view('financial-dashboard', compact('users', 'startDate', 'endDate'));
    }
}
