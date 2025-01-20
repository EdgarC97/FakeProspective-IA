<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Expense;

class ExpenseSeeder extends Seeder
{
    public function run()
    {
        $categories = ['Groceries', 'Utilities', 'Entertainment', 'Transportation'];

        foreach (range(1, 5) as $userId) {
            foreach ($categories as $category) {
                Expense::create([
                    'user_id' => $userId,
                    'category' => $category,
                    'total_amount' => rand(5000, 50000) / 100,
                    'start_date' => now()->subMonths(3),
                    'end_date' => now(),
                ]);
            }
        }
    }
}
