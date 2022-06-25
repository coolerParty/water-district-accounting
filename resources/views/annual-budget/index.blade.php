@extends('layouts.front')

@section('content')
@section('title', 'Annual Budget')
<!-- Main content header -->
<div class="flex flex-col items-start justify-between pb-6 space-y-4 border-b lg:items-center lg:space-y-0 lg:flex-row">
    <h1 class="text-2xl font-semibold whitespace-nowrap">Annual Budget</h1>
    <!-- <a href="https://github.com/Kamona-WD/starter-dashboard-layout" target="_blank" class=" -->
    @can('user-create')
    <!-- Modal Start-->
    <div x-data="{
        open: false,
        accept() {
            console.log('accepted')
        }
    }">
        <button @click="open = true"
            class="inline-flex items-center px-6 py-2 space-x-1 text-white bg-purple-600 rounded-md shadow hover:bg-opacity-95">
            <span>
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M11 15l-3-3m0 0l3-3m-3 3h8M3 12a9 9 0 1118 0 9 9 0 01-18 0z" />
                </svg>
            </span>
            <span>Add New</span>
        </button>
        <template x-teleport="body">
            <!-- Backdrop -->
            <div x-show="open"
                class="fixed top-0 bottom-0 left-0 right-0 z-10 flex items-center justify-center bg-black/50">
                <!-- Dialog -->
                <div x-show="open" x-transition @click.outside="open = false"
                    class="w-[90%] md:w-1/2 bg-white rounded-lg">
                    <!-- Modal Title -->
                    <div
                        class="flex items-center justify-between px-4 py-2 text-lg font-semibold bg-gray-100 rounded-t-lg">
                        <h2>Modal Title</h2>
                        <button @click="open = false" type="button">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                    <!-- Modal Body -->
                    <form method="POST" action="{{ route('annual-budget.store') }}">
                        @csrf
                        <div class="p-4">
                            <x-jet-validation-errors class="mb-4" />
                            <div class="mt-4">
                                <div>
                                    <label for="accountCode" class="text-gray-700 dark:text-gray-200">account
                                        code</label>
                                    <select id="accountCode" name="accountCode" autocomplete="accountCode-name" required
                                        class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-200 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 focus:ring-blue-300 focus:ring-opacity-40 dark:focus:border-blue-300 focus:outline-none focus:ring">
                                        <option value="">Select Account Code</option>
                                        @foreach($accounts as $account)
                                        <option value="{{ $account->id }}">{{ $account->code . ' - ' . $account->name }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="mt-4">
                                <div>
                                    <label for="budget_year" class="text-gray-700 dark:text-gray-200">budget
                                        year</label>
                                    <input id="budget_year" type="number" name="budget_year"
                                        value="{{ old('budget_year') }}" required autofocus autocomplete="budget_year"
                                        class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-200 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 focus:ring-blue-300 focus:ring-opacity-40 dark:focus:border-blue-300 focus:outline-none focus:ring">
                                </div>
                            </div>
                            <div class="mt-4">
                                <div>
                                    <label for="amount" class="text-gray-700 dark:text-gray-200">amount</label>
                                    <input id="amount" type="number" name="amount" value="{{ old('amount') }}" required
                                        autofocus autocomplete="amount"
                                        class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-200 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 focus:ring-blue-300 focus:ring-opacity-40 dark:focus:border-blue-300 focus:outline-none focus:ring">
                                </div>
                            </div>
                        </div>
                        <!-- Modal Footer -->
                        <div class="flex justify-end px-4 py-2 space-x-2 bg-gray-100 rounded-b-lg">
                            @can('user-edit')
                            <button type="submit"
                                class="px-6 py-2 leading-5 text-white transition-colors duration-200 transform bg-gray-700 rounded-md hover:bg-gray-600 focus:outline-none focus:bg-gray-600">Save</button>
                            @endcan
                            @can('user-delete')
                            <x-link-secondary href="#" @click="open = false">
                                Cancel
                            </x-link-secondary>
                            @endcan
                        </div>
                    </form>
                </div>
            </div>
        </template>
    </div>
    <!-- Modal End-->
    @endcan
</div>
<div class="flex flex-col mt-6">
    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
            <div class="overflow-hidden border-b border-gray-200 rounded-md shadow-md">
                <div class="p-2">
                    <x-jet-validation-errors class="mb-4" />
                </div>
                <table class="min-w-full overflow-x-scroll divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col"
                                class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                Budget Year
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                Account Code
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                Amount
                            </th>
                            <th scope="col" class="relative px-6 py-3">
                                <span class="sr-only">Edit</span>
                            </th>
                        </tr>
                        <!-- flash message Start -->
                        @if(Session::has('create-success'))
                        <div x-data="{ msg:'true'}">
                            <template x-if="msg">
                                <div class="w-full text-white bg-blue-500">
                                    <div class="container flex items-center justify-between px-6 py-4 mx-auto">
                                        <div class="flex">
                                            <svg viewBox="0 0 40 40" class="w-6 h-6 fill-current">
                                                <path
                                                    d="M20 3.33331C10.8 3.33331 3.33337 10.8 3.33337 20C3.33337 29.2 10.8 36.6666 20 36.6666C29.2 36.6666 36.6667 29.2 36.6667 20C36.6667 10.8 29.2 3.33331 20 3.33331ZM21.6667 28.3333H18.3334V25H21.6667V28.3333ZM21.6667 21.6666H18.3334V11.6666H21.6667V21.6666Z">
                                                </path>
                                            </svg>

                                            <p class="mx-3">{{ Session::get('create-success') }}</p>
                                        </div>

                                        <button @click="msg = '' "
                                            class="p-1 transition-colors duration-200 transform rounded-md hover:bg-opacity-25 hover:bg-gray-600 focus:outline-none">
                                            <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path d="M6 18L18 6M6 6L18 18" stroke="currentColor" stroke-width="2"
                                                    stroke-linecap="round" stroke-linejoin="round" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </template>
                        </div>
                        @endif
                        @if(Session::has('update-success'))
                        <div x-data="{ msg:'true'}">
                            <template x-if="msg">
                                <div class="w-full text-white bg-emerald-500">
                                    <div class="container flex items-center justify-between px-6 py-4 mx-auto">
                                        <div class="flex">
                                            <svg viewBox="0 0 40 40" class="w-6 h-6 fill-current">
                                                <path
                                                    d="M20 3.33331C10.8 3.33331 3.33337 10.8 3.33337 20C3.33337 29.2 10.8 36.6666 20 36.6666C29.2 36.6666 36.6667 29.2 36.6667 20C36.6667 10.8 29.2 3.33331 20 3.33331ZM16.6667 28.3333L8.33337 20L10.6834 17.65L16.6667 23.6166L29.3167 10.9666L31.6667 13.3333L16.6667 28.3333Z">
                                                </path>
                                            </svg>

                                            <p class="mx-3">{{ Session::get('update-success') }}</p>
                                        </div>

                                        <button @click="msg = '' "
                                            class="p-1 transition-colors duration-200 transform rounded-md hover:bg-opacity-25 hover:bg-gray-600 focus:outline-none">
                                            <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path d="M6 18L18 6M6 6L18 18" stroke="currentColor" stroke-width="2"
                                                    stroke-linecap="round" stroke-linejoin="round" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </template>
                        </div>
                        @endif
                        @if(Session::has('delete-success'))
                        <div x-data="{ msg:'true'}">
                            <template x-if="msg">
                                <div class="w-full text-white bg-red-500">
                                    <div class="container flex items-center justify-between px-6 py-4 mx-auto">
                                        <div class="flex">
                                            <svg viewBox="0 0 40 40" class="w-6 h-6 fill-current">
                                                <path
                                                    d="M20 3.36667C10.8167 3.36667 3.3667 10.8167 3.3667 20C3.3667 29.1833 10.8167 36.6333 20 36.6333C29.1834 36.6333 36.6334 29.1833 36.6334 20C36.6334 10.8167 29.1834 3.36667 20 3.36667ZM19.1334 33.3333V22.9H13.3334L21.6667 6.66667V17.1H27.25L19.1334 33.3333Z">
                                                </path>
                                            </svg>

                                            <p class="mx-3">{{ Session::get('delete-success') }}</p>
                                        </div>

                                        <button @click="msg = '' "
                                            class="p-1 transition-colors duration-200 transform rounded-md hover:bg-opacity-25 hover:bg-gray-600 focus:outline-none">
                                            <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path d="M6 18L18 6M6 6L18 18" stroke="currentColor" stroke-width="2"
                                                    stroke-linecap="round" stroke-linejoin="round" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </template>
                        </div>
                        @endif
                        <!-- flash message End -->
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($budgets as $budget)
                        <tr class="transition-all hover:bg-gray-100 hover:shadow-lg">
                            <td class="px-3 py-1 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">{{ $budget->budget_year }}</div>
                            </td>
                            <td class="px-3 py-1 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">{{ $budget->accountChart->name }}</div>
                            </td>
                            <td class="px-3 py-1 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">{{ number_format($budget->amount,2) }}</div>
                            </td>
                            <td class="px-3 py-1 text-sm font-medium text-right whitespace-nowrap">
                                @can('user-edit')
                                <x-link-success href="{{ route('annual-budget.edit', $budget) }}" class="">Edit
                                </x-link-success>
                                @endcan
                                @can('user-delete')
                                <form method="POST" action="{{ route('annual-budget.destroy', $budget) }}"
                                    class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <x-jet-danger-button type="submit" onclick="return confirm('Are you sure?')">
                                        Delete</x-jet-danger-button>
                                </form>
                                @endcan
                            </td>
                        </tr>
                        @empty
                        <tr class="transition-all hover:bg-gray-100 hover:shadow-lg">
                            <td colspan="4" class="p-4 text-center whitespace-nowrap">
                                <div class="text-gray-900 font-small">
                                    <h1>No Annual Budget Found.</h1>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="p-4 bg-gray-100">
                    {!! $budgets->links() !!}
                </div>
            </div>
        </div>
    </div>


</div>
@endsection
