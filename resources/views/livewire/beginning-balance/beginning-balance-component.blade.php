<div>
    @section('title', 'Beginnning Balance')
    <!-- Main content header -->
    <div
        class="flex flex-col items-start justify-between pb-6 space-y-4 border-b lg:items-center lg:space-y-0 lg:flex-row">
        <h1 class="text-2xl font-semibold whitespace-nowrap">Beginnning Balance</h1>
        <!-- <a href="https://github.com/Kamona-WD/starter-dashboard-layout" target="_blank" class=" -->
        @can('user-create')
            <button href="#" wire:click="showAddForm"
                class="inline-flex items-center justify-center px-4 py-1 space-x-1 bg-gray-200 rounded-md shadow hover:bg-opacity-20">
                <span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-gray-400" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </span>
                <span>Add New</span>
            </button>
        @endcan
    </div>
    <div class="flex flex-col mt-6">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                <div class="overflow-hidden border-b border-gray-200 rounded-md shadow-md">
                    <table class="min-w-full overflow-x-scroll divide-y divide-gray-200">
                        @if($enableAdd)
                            <tr class="transition-all bg-gray-200 hover:shadow-lg">
                                <div class="p-4">
                                    <x-jet-validation-errors class="mb-4" />
                                </div>
                                <td class="px-3 py-4 whitespace-nowrap">New
                                </td>
                                <td colspan="2" class="px-1 py-4 whitespace-nowrap">
                                    <div>
                                        <select id="accountCode" name="accountCode" autocomplete="accountCode-name"
                                            wire:model="accountCode"
                                            class="block w-full px-4 py-2 mt-2 text-sm bg-white border border-gray-200 rounded-md shadow-sm dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:outline-none focus:ring focus:border-blue-400 dark:focus:border-blue-300">
                                            <option value="">Select Account Code</option>
                                            @foreach($accountChartCodes as $accountChartCode)
                                            <option value="{{ $accountChartCode->id }}">{{ $accountChartCode->code . ' -
                                                ' . $accountChartCode->name
                                                }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </td>
                                <td class="px-1 py-4 whitespace-nowrap">
                                    <div>
                                        <input id="start_date" type="date" name="start_date"
                                            value="{{ old('start_date') }}" wire:model="start_date" required autofocus
                                            autocomplete="code"
                                            class="block w-full px-4 py-2 mt-2 text-sm text-gray-700 bg-white border border-gray-200 rounded-md shadow-sm dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 focus:ring-blue-300 focus:ring-opacity-40 dark:focus:border-blue-300 focus:outline-none focus:ring">
                                    </div>
                                </td>
                                <td class="px-1 py-4 whitespace-nowrap">
                                    <div>
                                        <input id="amount" type="number" name="amount" value="{{ old('amount') }}"
                                            wire:model="amount" required autofocus autocomplete="code"
                                            class="block w-full px-4 py-2 mt-2 text-sm text-gray-700 bg-white border border-gray-200 rounded-md shadow-sm dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 focus:ring-blue-300 focus:ring-opacity-40 dark:focus:border-blue-300 focus:outline-none focus:ring">
                                    </div>
                                </td>
                                <td class="px-1 py-4 text-sm font-medium text-right whitespace-nowrap">
                                    <form wire:submit.prevent="store">
                                        @can('user-edit')
                                        <button type="submit"
                                            class="px-6 py-2 leading-5 text-white transition-colors duration-200 transform bg-gray-700 rounded-md hover:bg-gray-600 focus:outline-none focus:bg-gray-600">Save</button>
                                        @endcan
                                        @can('user-delete')
                                        <x-link-secondary href="#" wire:click="resetAddEdit">
                                            Cancel
                                        </x-link-secondary>
                                        @endcan
                                    </form>
                                </td>
                            </tr>
                            @endif
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col"
                                    class="p-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                    #
                                </th>
                                <th scope="col"
                                    class="p-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                    Code
                                </th>
                                <th scope="col"
                                    class="p-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                    Name
                                </th>
                                <th scope="col"
                                    class="p-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                    Start Date
                                </th>
                                <th scope="col"
                                    class="p-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                    Amount
                                </th>
                                <th scope="col" class="p-3">
                                    <span class="sr-only">Action</span>
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
                                                    <path d="M6 18L18 6M6 6L18 18" stroke="currentColor"
                                                        stroke-width="2" stroke-linecap="round"
                                                        stroke-linejoin="round" />
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
                                                    <path d="M6 18L18 6M6 6L18 18" stroke="currentColor"
                                                        stroke-width="2" stroke-linecap="round"
                                                        stroke-linejoin="round" />
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
                                                    <path d="M6 18L18 6M6 6L18 18" stroke="currentColor"
                                                        stroke-width="2" stroke-linecap="round"
                                                        stroke-linejoin="round" />
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
                            @forelse($balances as $balance)
                            @if (
                            ($enableAdd == false && $enableEdit == false)
                            ||
                            ($enableAdd == true && $enableEdit == false)
                            ||
                            ($enableAdd == false && $enableEdit == true && $bal_id != $balance->id)
                            )
                            <tr class="transition-all hover:bg-gray-100 hover:shadow-lg">
                                <td class="px-3 py-1 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900">{{ $loop->iteration}}</div>
                                </td>
                                <td class="px-3 py-1 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900">{{ $balance->accountchart->code }}
                                    </div>
                                </td>
                                <td class="px-3 py-1 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900">{{ $balance->accountchart->name }}
                                    </div>
                                </td>
                                <td class="px-3 py-1 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900">{{ $balance->start_date }}</div>
                                </td>
                                <td class="px-3 py-1 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900">{{ number_format($balance->amount,2)
                                        }}</div>
                                </td>
                                <td class="px-3 py-1 text-sm font-medium text-right whitespace-nowrap">
                                    @can('user-edit')
                                    <x-link-success href="#" wire:click.prevent="showEditForm('{{ $balance->id }}')">
                                        Edit
                                    </x-link-success>
                                    @can('user-delete')
                                    @endcan
                                    <x-link-danger href="#" class="btn btn-danger btn-sm text-light"
                                        onclick="confirm('Are you sure, You want to delete this account chart?') || event.stopImmediatePropagation()"
                                        wire:click.prevent="destroy({{ $balance->id }})">
                                        Delete
                                    </x-link-danger>
                                    @endcan
                                </td>
                            </tr>
                            @elseif($enableAdd == false && $enableEdit == true && $bal_id == $balance->id)
                            <div class="p-4">
                                <x-jet-validation-errors class="mb-4" />
                            </div>
                            <tr class="transition-all bg-gray-100">
                                <td class="px-3 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900">{{ $loop->iteration }}</div>
                                </td>
                                <td colspan="2" class="px-1 py-4 whitespace-nowrap">
                                    <select id="accountCode" name="accountCode" autocomplete="accountCode-name"
                                        wire:model="accountCode"
                                        class="block w-full px-4 py-2 bg-white border border-gray-200 rounded-md shadow-sm dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:outline-none focus:ring focus:border-blue-400 dark:focus:border-blue-300 sm:text-sm">
                                        <option value="">Select Account Code</option>
                                        @foreach($accountChartCodes as $accountChartCode)
                                        <option value="{{ $accountChartCode->id }}">{{ $accountChartCode->code . ' -
                                            ' . $accountChartCode->name
                                            }}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td class="px-1 py-4 whitespace-nowrap">
                                    <input id="start_date" type="date" name="start_date" wire:model="start_date"
                                        required autofocus autocomplete="code"
                                        class="block w-full px-4 py-2 text-gray-700 bg-white border border-gray-200 rounded-md shadow-sm sm:text-sm dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 focus:ring-blue-300 focus:ring-opacity-40 dark:focus:border-blue-300 focus:outline-none focus:ring">
                                </td>
                                <td class="px-1 py-4 whitespace-nowrap">
                                    <input id="amount" type="number" name="amount" value="{{ old('amount') }}"
                                        wire:model.defer="amount" required autofocus autocomplete="amount"
                                        class="block w-full px-4 py-2 text-gray-700 bg-white border border-gray-200 rounded-md shadow-sm sm:text-sm dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 focus:ring-blue-300 focus:ring-opacity-40 dark:focus:border-blue-300 focus:outline-none focus:ring">
                                </td>
                                <td class="px-1 py-4 text-sm font-medium text-right whitespace-nowrap">
                                    <form wire:submit.prevent="update">
                                        @can('user-edit')
                                        <button type="submit"
                                            class="px-6 py-2 leading-5 text-white transition-colors duration-200 transform bg-gray-700 rounded-md hover:bg-gray-600 focus:outline-none focus:bg-gray-600">Update</button>
                                        @endcan
                                        @can('user-delete')
                                        <x-link-secondary href="#" wire:click="resetAddEdit">
                                            Cancel
                                        </x-link-secondary>
                                        @endcan
                                    </form>
                                </td>
                            </tr>
                            @endif
                            @empty
                            <tr class="transition-all hover:bg-gray-100 hover:shadow-lg">
                                <td></td>
                                <td></td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900">No Beginning Balance Found!</div>
                                </td>
                                <td></td>
                                <td></td>
                                <td class="px-6 py-4 text-sm font-medium text-right whitespace-nowrap">
                                </td>
                            </tr>
                            @endforelse

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>
