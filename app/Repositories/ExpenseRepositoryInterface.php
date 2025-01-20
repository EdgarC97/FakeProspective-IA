<?php

namespace App\Repositories;

interface ExpenseRepositoryInterface
{
    public function getExpenses($userId, $startDate, $endDate);
}
