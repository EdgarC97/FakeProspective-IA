<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FinancialDataController;


Route::get('/financial-data/{userId}', [FinancialDataController::class, 'getData']);
