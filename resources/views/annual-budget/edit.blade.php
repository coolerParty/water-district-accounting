@extends('layouts.front')

@section('content')
@section('title', 'Annual Budget / Edit')
<!-- Main content header -->
<div
    class="flex flex-col items-start justify-between pb-6 mb-4 space-y-4 border-b lg:items-center lg:space-y-0 lg:flex-row">
    <h1 class="text-lg font-semibold whitespace-nowrap">Permission <span class="text-base text-gray-400">/</span> Edit
        <span class="text-base text-gray-400">/</span> <span class="text-2xl">{{ $budget->accountChart->name }}</span>
    </h1>
    <a href="{{ route('annual-budget.index') }}"
        class="inline-flex items-center px-6 py-2 space-x-1 text-white bg-purple-600 rounded-md shadow hover:bg-opacity-95">
        <span>
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 " fill="none" viewBox="0 0 24 24"
                stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M11 15l-3-3m0 0l3-3m-3 3h8M3 12a9 9 0 1118 0 9 9 0 01-18 0z" />
            </svg>
        </span>
        <span>Back</span>
    </a>
</div>

<div class="max-w-full max-h-screen md:bg-gray-300 md:p-4">
    <section class="max-w-4xl p-6 mx-auto bg-white rounded-md shadow-md dark:bg-gray-800">
        <form method="POST" action="{{ route('annual-budget.update', $budget) }}">
            @csrf
            @method('PUT')
            <div class="mt-4">
                <div>
                    <label for="accountCode" class="text-gray-700 dark:text-gray-200">account
                        code</label>
                    <select id="accountCode" name="accountCode" autocomplete="accountCode-name" required
                        value="{{ $budget->accountchart_id }}"
                        class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-200 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 focus:ring-blue-300 focus:ring-opacity-40 dark:focus:border-blue-300 focus:outline-none focus:ring">
                        <option value="">Select Account Code</option>
                        @foreach($accounts as $account)
                        <option value="{{ $account->id }}" {{ ($budget->accountchart_id == $account->id) ? 'selected' :
                            '' }}>{{ $account->code . ' - ' . $account->name }}
                        </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="mt-4">
                <div>
                    <label for="budget_year" class="text-gray-700 dark:text-gray-200">budget
                        year</label>
                    <input id="budget_year" type="number" name="budget_year" value="{{ $budget->budget_year }}"
                        value="{{ old('budget_year') }}" required autofocus autocomplete="budget_year"
                        class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-200 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 focus:ring-blue-300 focus:ring-opacity-40 dark:focus:border-blue-300 focus:outline-none focus:ring">
                </div>
            </div>

            <div class="mt-4">
                <div>
                    <label for="amount" class="text-gray-700 dark:text-gray-200">amount</label>
                    <input id="amount" type="number" name="amount" value="{{ $budget->amount }}" required autofocus
                        autocomplete="amount"
                        class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-200 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 focus:ring-blue-300 focus:ring-opacity-40 dark:focus:border-blue-300 focus:outline-none focus:ring">
                </div>
            </div>

            <div class="flex justify-end mt-6">
                <button type="submit"
                    class="px-6 py-2 leading-5 text-white transition-colors duration-200 transform bg-gray-700 rounded-md hover:bg-gray-600 focus:outline-none focus:bg-gray-600">
                    Update
                </button>
            </div>
        </form>
    </section>
</div>
@endsection
