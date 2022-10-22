<div>
    @section('title', 'General Journal / Create')
    <!-- Main content header -->
    <div
        class="flex flex-col items-start justify-between pb-6 mb-2 space-y-4 border-b lg:items-center lg:space-y-0 lg:flex-row">
        <h1 class="text-lg font-semibold whitespace-nowrap">General Journal <span
                class="text-base text-gray-400">/</span>
            <span class="text-2xl">Create</span>
        </h1>
        <a href="{{ route('generaljournal.index') }}"
            class="inline-flex items-center px-6 py-2 space-x-1 text-white bg-purple-600 rounded-md shadow hover:bg-opacity-95">
            <span>
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M11 15l-3-3m0 0l3-3m-3 3h8M3 12a9 9 0 1118 0 9 9 0 01-18 0z" />
                </svg>
            </span>
            <span>Back</span>
        </a>
    </div>
    <div class="max-w-full md:p-4">

        <section class="max-w-4xl p-6 mx-auto mb-4 bg-white rounded-md shadow-md dark:bg-gray-800">
            <form class="w-full" wire:submit.prevent="store">
                <div class="flex flex-wrap mb-6 -mx-3">
                    <div class="w-full px-3 mb-6 md:w-1/2 md:mb-0">
                        <label class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase"
                            for="jev_date">
                            Jev Date
                        </label>
                        <input id="jev_date" type="date" value="{{ old('jev_date') }}" wire:model="jev_date"
                            class="block w-full px-4 py-3 leading-tight text-gray-700 bg-gray-200 border @error('jev_date') mb-3 border-red-500 @else border-gray-200 focus:border-gray-500 @enderror rounded appearance-none focus:outline-none focus:bg-white">
                        @error('jev_date')<p class="text-xs italic text-red-500">{{ $message }}</p>@enderror
                    </div>
                    <div class="w-full px-3 mb-6 md:w-1/2 md:mb-0">
                        <label class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase"
                            for="gen_number">
                            GJ Number
                        </label>
                        <div class="flex flex-wrap space-x-1">
                            <input id="gen_number" type="text" value="{{ old('gen_number') }}" wire:model="gen_number"
                                class="block w-3.5/5 px-4 py-3 leading-tight text-gray-700 bg-gray-200 border @error('gen_number') mb-3 border-red-500 @else border-gray-200 focus:border-gray-500 @enderror rounded appearance-none focus:outline-none focus:bg-white">

                            <x-link-success href="#" wire:click.prevent="getMaxGJNumber" class="w-1.5/5">
                                GJ Number
                            </x-link-success>
                        </div>
                        @error('gen_number')<p class="text-xs italic text-red-500">{{ $message }}</p>@enderror
                    </div>
                </div>
                <div class="flex flex-wrap mb-6 -mx-3">
                    <div class="w-full px-3 mb-6">
                        <label class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase"
                            for="g_particulars">
                            GJ particulars
                        </label>
                        <textarea id="g_particulars" type="number" step="any" placeholder="Enter GJ particulars"
                            wire:model="g_particulars" rows="5"
                            class="block w-full px-4 py-3 leading-tight text-gray-700 bg-gray-200 border @error('arrears_py') mb-3 border-red-500 @else border-gray-200 focus:border-gray-500 @enderror rounded appearance-none focus:outline-none focus:bg-white"></textarea>
                        @error('g_particulars')<p class="text-xs italic text-red-500">{{ $message }}</p>@enderror
                    </div>
                </div>
                <div class="flex flex-wrap mb-6 -mx-3">
                    <div class="w-full px-3 mb-6">
                        <label class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase"
                            for="particulars">
                            Particulars
                        </label>
                        <textarea id="particulars" type="number" step="any" placeholder="Enter Particulars"
                            wire:model="particulars" rows="5"
                            class="block w-full px-4 py-3 leading-tight text-gray-700 bg-gray-200 border @error('arrears_py') mb-3 border-red-500 @else border-gray-200 focus:border-gray-500 @enderror rounded appearance-none focus:outline-none focus:bg-white"></textarea>
                        @error('particulars')<p class="text-xs italic text-red-500">{{ $message }}</p>@enderror
                    </div>
                </div>
                <div class="flex flex-wrap mb-6 -mx-3">
                    <div class="w-full px-3">
                        <div class="card">
                            <div class="card-header">
                                Journal Entry Vouchers
                            </div>

                            <div class="card-body">
                                <table class="min-w-full overflow-x-scroll divide-y divide-gray-200">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th scope="col"
                                                class="p-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                                Find
                                            </th>
                                            <th scope="col"
                                                class="p-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                                account code
                                            </th>
                                            <th scope="col"
                                                class="p-3 text-xs font-medium tracking-wider text-center text-gray-500 uppercase">
                                                debit
                                            </th>
                                            <th scope="col"
                                                class="p-3 text-xs font-medium tracking-wider text-center text-gray-500 uppercase">
                                                credit
                                            </th>
                                            <th scope="col"
                                                class="p-3 text-xs font-medium tracking-wider text-center text-gray-500 uppercase">
                                                Action
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        @foreach ($journals as $index => $jev)
                                        <tr class="transition-all hover:bg-gray-100">
                                            <td class="p-2">
                                                <button wire:click.prevent="showSearchAccounts({{ $index }})"
                                                    class="px-6 py-2 mr-2 leading-5 text-white transition-colors duration-200 transform bg-purple-700 rounded-md hover:bg-purple-600 focus:outline-none focus:bg-gray-600">
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                        fill="currentColor" class="w-5 h-5">
                                                        <path fill-rule="evenodd"
                                                            d="M9 3.5a5.5 5.5 0 100 11 5.5 5.5 0 000-11zM2 9a7 7 0 1112.452 4.391l3.328 3.329a.75.75 0 11-1.06 1.06l-3.329-3.328A7 7 0 012 9z"
                                                            clip-rule="evenodd" />
                                                    </svg>
                                                </button>
                                            </td>
                                            <td class="p-2 whitespace-nowrap">
                                                <select name="journals[{{ $index }}][accountCode]"
                                                    wire:model="journals.{{ $index }}.accountCode"
                                                    class="block w-full p-2 leading-tight text-gray-700 bg-gray-200 border border-gray-200 rounded appearance-none focus:outline-none focus:bg-white focus:border-gray-500">
                                                    <option value="">Select Account</option>
                                                    @foreach($accounts as $account)
                                                    <option value="{{ $account->id }}">{{ $account->code . ' - ' .
                                                        $account->name }}</option>
                                                    @endforeach
                                                </select>
                                                @error('journals.{{ $index }}.accountCode')<p
                                                    class="text-xs italic text-red-500">{{ $message }}</p>@enderror
                                            </td>
                                            <td class="p-2 whitespace-nowrap">
                                                <input type="number" step="any" name="journals[{{ $index }}][debit]"
                                                    class="block w-full p-2 leading-tight text-right text-gray-700 bg-gray-200 border border-gray-200 rounded appearance-none focus:outline-none focus:bg-white focus:border-gray-500"
                                                    wire:model="journals.{{ $index }}.debit" />
                                                @error('journals.{{ $index }}.debit')<p
                                                    class="text-xs italic text-red-500">{{ $message }}</p>@enderror
                                            </td>
                                            <td class="p-2 whitespace-nowrap">
                                                <input type="number" step="any" name="subTasks[{{ $index }}][credit]"
                                                    class="block w-full p-2 leading-tight text-right text-gray-700 bg-gray-200 border border-gray-200 rounded appearance-none focus:outline-none focus:bg-white focus:border-gray-500"
                                                    wire:model="journals.{{ $index }}.credit" />
                                                @error('journals.{{ $index }}.credit')<p
                                                    class="text-xs italic text-red-500">{{ $message }}</p>@enderror
                                            </td>
                                            <td class="p-2 whitespace-nowrap">
                                                <x-link-danger href="#" wire:click.prevent="removeJournal({{ $index }})"
                                                    class="btn btn-danger text-light">Delete</x-link-danger>
                                            </td>
                                        </tr>
                                        @endforeach
                                        <tr class="transition-all bg-gray-400">
                                            <td class="p-2 whitespace-nowrap" colspan="2">
                                                Total
                                            </td>
                                            <td class="p-2 whitespace-nowrap">
                                                <input type="number" step="any" min="0"
                                                    value="{{ array_sum(array_column($journals,'debit')) }}"
                                                    class="block w-full p-2 leading-tight text-right text-gray-700 border border-gray-200 rounded appearance-none bg-gray-50 focus:outline-none focus:bg-white focus:border-gray-500"
                                                    disabled />
                                            </td>
                                            <td class="p-2 whitespace-nowrap">
                                                <input type="number" step="any" min="0"
                                                    value="{{ array_sum(array_column($journals,'credit')) }}"
                                                    class="block w-full p-2 leading-tight text-right text-gray-700 border border-gray-200 rounded appearance-none bg-gray-50 focus:outline-none focus:bg-white focus:border-gray-500"
                                                    disabled />
                                            </td>
                                            <td class="p-2 whitespace-nowrap">

                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <div class="w-full p-3">
                                    @error('journals')<p class="text-xs italic text-red-500">{{ $message }}</p>@enderror
                                    <button type="button"
                                        class="px-6 py-2 leading-5 text-white transition-colors duration-200 transform bg-gray-700 rounded-md hover:bg-gray-600 focus:outline-none focus:bg-gray-600"
                                        wire:click.prevent="addJournal">+ Add Another Account</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex justify-end mt-6">
                    <button type="submit"
                        class="px-6 py-2 leading-5 text-white transition-colors duration-200 transform bg-gray-700 rounded-md hover:bg-gray-600 focus:outline-none focus:bg-gray-600">Save</button>
                </div>
            </form>
        </section>
    </div>
    {{-- Show-Modal Start --}}
    <style>
        .modal-body {
            max-height: calc(100vh - 200px) !important;
            overflow-y: auto !important;
        }
    </style>
    <x-jet-dialog-modal wire:model="showModal">
        <x-slot name="title">Search Accounts</x-slot>
        <x-slot name="content" class="w-full">
            <div class="w-full modal-body ">
                <!-- <x-jet-validation-errors class="mb-4" /> -->
                <section class="max-w-4xl p-2 mx-auto dark:bg-gray-800">

                        <div class="w-full px-2 mb-2">
                            <!-- <label class="text-gray-700 dark:text-gray-200" for="search">Search</label> -->
                            <input id="search" type="text" name="search" value="{{ old('search') }}"
                                wire:model.lazy="search" required autofocus autocomplete="search"
                                class="block w-full px-4 py-2 mt-2 text-gray-700 border border-gray-300 rounded-md bg-gray-50 dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 focus:ring-blue-300 focus:ring-opacity-40 dark:focus:border-blue-300 focus:outline-none focus:ring ">
                        </div>

                    <table class="min-w-full overflow-x-scroll divide-y divide-gray-200">
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($accountsModal as $item)
                            <tr class="transition-all hover:bg-gray-100">
                                <td class="p-2"><button type="button"
                                        wire:click.prevent="selectAccount({{ $item->id }})"
                                        class="px-6 py-2 leading-5 text-white transition-colors duration-200 transform bg-gray-700 rounded-md hover:bg-gray-600 focus:outline-none focus:bg-gray-600">Select</button>
                                </td>
                                <td class="p-2 text-xs dark:text-white">{{ $item->code }}</td>
                                <td class="p-2 text-xs dark:text-white">{{ $item->name }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3" class="p-2 dark:text-white">No item found!</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </section>
            </div>
        </x-slot>
        <x-slot name="footer">
            <x-link-danger type="button" wire:click.prevent="closeModal"
                class="text-white bg-gray-600 cursor-pointer hover:bg-gray-800">Close</x-link-danger>
        </x-slot>
    </x-jet-dialog-modal>
    {{-- Show-Modal End --}}
</div>
