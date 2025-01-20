<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FinancialDashboardController;

Route::get('/', [FinancialDashboardController::class, 'index']);

Route::get('/financial-dashboard', [FinancialDashboardController::class, 'index']);
