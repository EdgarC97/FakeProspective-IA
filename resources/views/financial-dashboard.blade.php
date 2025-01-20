@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-8 text-center">Financial Dashboard</h1>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @foreach ($users as $userData)
            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                <div class="bg-blue-600 text-white p-4">
                    <h2 class="text-xl font-semibold">{{ $userData['user']->name }}</h2>
                    <p class="text-sm">{{ $userData['user']->email }}</p>
                </div>

                <div class="p-4">
                    <h3 class="text-lg font-semibold mb-2">Expenses</h3>
                    @if ($userData['expenses']->isNotEmpty())
                        <ul class="space-y-2">
                            @foreach ($userData['expenses'] as $expense)
                                <li class="flex justify-between items-center">
                                    <span class="text-gray-600">{{ $expense->category }}</span>
                                    <span class="font-medium">${{ number_format($expense->total_amount, 2) }}</span>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p class="text-gray-500">No expenses found.</p>
                    @endif
                </div>

                <div class="p-4 bg-gray-50">
                    <h3 class="text-lg font-semibold mb-2">Goals</h3>
                    @if ($userData['goals']->isNotEmpty())
                        <ul class="space-y-4">
                            @foreach ($userData['goals'] as $goal)
                                <li>
                                    <div class="flex justify-between items-center mb-1">
                                        <span class="font-medium">{{ $goal->type }}</span>
                                        <span class="text-sm text-gray-600">
                                            ${{ number_format($goal->current_progress, 2) }} / ${{ number_format($goal->target_amount, 2) }}
                                        </span>
                                    </div>
                                    <div class="w-full bg-gray-200 rounded-full h-2.5">
                                        @php
                                            $percentage = ($goal->current_progress / $goal->target_amount) * 100;
                                        @endphp
                                        <div class="bg-blue-600 h-2.5 rounded-full" style="width: {{ $percentage }}%"></div>
                                    </div>
                                    <div class="text-right text-xs text-gray-500 mt-1">
                                        {{ number_format($percentage, 1) }}%
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p class="text-gray-500">No goals found.</p>
                    @endif
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
