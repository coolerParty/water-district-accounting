<div>
    @section('title', 'Billing Journal / Create')
    <!-- Main content header -->
    <div
        class="flex flex-col items-start justify-between pb-6 mb-2 space-y-4 border-b lg:items-center lg:space-y-0 lg:flex-row">
        <h1 class="text-lg font-semibold whitespace-nowrap">Billing Journal <span class="text-base text-gray-400">/</span>
            <span class="text-2xl">Create</span>
        </h1>
        <a href="{{ route('billingjournal.index') }}"
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
                </div>
                <div class="flex flex-wrap -mx-3">
                    <div class="w-full px-3 mb-6 md:w-1/4">
                        <label class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase"
                            for="official_receipt">
                            Zone
                        </label>
                        <input id="official_receipt" type="text" placeholder="Zone"
                            value="{{ old('zone') }}" wire:model="zone"
                            class="block w-full px-4 py-3 leading-tight text-gray-700 bg-gray-200 border @error('zone') mb-3 border-red-500 @else border-gray-200 focus:border-gray-500 @enderror rounded appearance-none focus:outline-none focus:bg-white">
                        @error('zone')<p class="text-xs italic text-red-500">{{ $message }}</p>@enderror
                    </div>
                    <div class="w-full px-3 mb-6 md:w-1/4 md:mb-0">
                        <label class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase"
                            for="a_receipt">
                            Metered Sales
                        </label>
                        <input id="metered_sales" type="number" min="0" placeholder="Metered Sales" wire:model="metered_sales"
                            class="block w-full px-4 py-3 leading-tight text-gray-700 bg-gray-200 border @error('metered_sales') mb-3 border-red-500 @else border-gray-200 focus:border-gray-500 @enderror rounded appearance-none focus:outline-none focus:bg-white">
                        @error('metered_sales')<p class="text-xs italic text-red-500">{{ $message }}</p>@enderror
                    </div>
                    <div class="w-full px-3 mb-6 md:w-1/4">
                        <label class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase"
                            for="cod_prev_day">
                            Residential
                        </label>
                        <input id="residential" type="number" min="0" placeholder="Residential"
                            wire:model="residential"
                            class="block w-full px-4 py-3 leading-tight text-gray-700 bg-gray-200 border @error('residential') mb-3 border-red-500 @else border-gray-200 focus:border-gray-500 @enderror rounded appearance-none focus:outline-none focus:bg-white">
                        @error('residential')<p class="text-xs italic text-red-500">{{ $message }}</p>@enderror
                    </div>
                    <div class="w-full px-3 mb-6 md:w-1/4 md:mb-0">
                        <label class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase" for="current">
                            Commercial
                        </label>
                        <input id="comm" type="number" min="0" placeholder="Commercial" wire:model="comm"
                            class="block w-full px-4 py-3 leading-tight text-gray-700 bg-gray-200 border @error('comm') mb-3 border-red-500 @else border-gray-200 focus:border-gray-500 @enderror rounded appearance-none focus:outline-none focus:bg-white">
                        @error('comm')<p class="text-xs italic text-red-500">{{ $message }}</p>@enderror
                    </div>
                </div>
                <div class="flex flex-wrap mb-6 -mx-3">
                    <div class="w-full px-3 mb-6 md:w-1/4 md:mb-0">
                        <label class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase" for="penalty">
                            Commercial A
                        </label>
                        <input id="comm_a" type="number" min="0" placeholder="Commercial A" wire:model="comm_a"
                            class="block w-full px-4 py-3 leading-tight text-gray-700 bg-gray-200 border @error('comm_a') mb-3 border-red-500 @else border-gray-200 focus:border-gray-500 @enderror rounded appearance-none focus:outline-none focus:bg-white">
                        @error('comm_a')<p class="text-xs italic text-red-500">{{ $message }}</p>@enderror
                    </div>
                    <div class="w-full px-3 mb-6 md:w-1/4 md:mb-0">
                        <label class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase"
                            for="arrears_cy">
                            Commercial B
                        </label>
                        <input id="comm_b" type="number" min="0" placeholder="Commercial B"
                            wire:model="comm_b"
                            class="block w-full px-4 py-3 leading-tight text-gray-700 bg-gray-200 border @error('comm_b') mb-3 border-red-500 @else border-gray-200 focus:border-gray-500 @enderror rounded appearance-none focus:outline-none focus:bg-white">
                        @error('comm_b')<p class="text-xs italic text-red-500">{{ $message }}</p>@enderror
                    </div>
                    <div class="w-full px-3 mb-6 md:w-1/4 md:mb-0">
                        <label class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase"
                            for="arrears_py">
                            Commercial c
                        </label>
                        <input id="comm_c" type="number" min="0" placeholder="Commercial C"
                            wire:model="comm_c"
                            class="block w-full px-4 py-3 leading-tight text-gray-700 bg-gray-200 border @error('comm_c') mb-3 border-red-500 @else border-gray-200 focus:border-gray-500 @enderror rounded appearance-none focus:outline-none focus:bg-white">
                        @error('comm_c')<p class="text-xs italic text-red-500">{{ $message }}</p>@enderror
                    </div>
                    <div class="w-full px-3 mb-6 md:w-1/4 md:mb-0">
                        <label class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase"
                            for="arrears_py">
                            Government
                        </label>
                        <input id="government" type="number" min="0" placeholder="Government"
                            wire:model="government"
                            class="block w-full px-4 py-3 leading-tight text-gray-700 bg-gray-200 border @error('government') mb-3 border-red-500 @else border-gray-200 focus:border-gray-500 @enderror rounded appearance-none focus:outline-none focus:bg-white">
                        @error('government')<p class="text-xs italic text-red-500">{{ $message }}</p>@enderror
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
                            class="block w-full px-4 py-3 leading-tight text-gray-700 bg-gray-200 border @error('arrears_py') mb-3 border-red-500 @else border-gray-200 focus:border-gray-500 @enderror rounded appearance-none focus:outline-none focus:bg-white"
                            ></textarea>
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

                                                <td class="p-2 whitespace-nowrap">
                                                    <select name="journals[{{ $index }}][accountCode]"
                                                        wire:model="journals.{{ $index }}.accountCode" class="block w-full p-2 leading-tight text-gray-700 bg-gray-200 border border-gray-200 rounded appearance-none focus:outline-none focus:bg-white focus:border-gray-500">
                                                        <option value="">Select Account</option>
                                                        @foreach($accounts as $account)
                                                        <option value="{{ $account->id }}">{{ $account->code . ' - ' . $account->name }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('journals.{{ $index }}.accountCode')<p class="text-xs italic text-red-500">{{ $message }}</p>@enderror
                                                </td>
                                                <td class="p-2 whitespace-nowrap">
                                                    <input type="number" step="any" name="journals[{{ $index }}][debit]" class="block w-full p-2 leading-tight text-right text-gray-700 bg-gray-200 border border-gray-200 rounded appearance-none focus:outline-none focus:bg-white focus:border-gray-500"
                                                        wire:model="journals.{{ $index }}.debit" />
                                                        @error('journals.{{ $index }}.debit')<p class="text-xs italic text-red-500">{{ $message }}</p>@enderror
                                                </td>
                                                <td class="p-2 whitespace-nowrap">
                                                    <input type="number" step="any"  name="subTasks[{{ $index }}][credit]" class="block w-full p-2 leading-tight text-right text-gray-700 bg-gray-200 border border-gray-200 rounded appearance-none focus:outline-none focus:bg-white focus:border-gray-500"
                                                        wire:model="journals.{{ $index }}.credit" />
                                                        @error('journals.{{ $index }}.credit')<p class="text-xs italic text-red-500">{{ $message }}</p>@enderror
                                                </td>
                                                <td class="p-2 whitespace-nowrap">
                                                    <x-link-danger href="#" wire:click.prevent="removeJournal({{ $index }})" class="btn btn-danger text-light">Delete</x-link-danger>
                                                </td>
                                            </tr>
                                        @endforeach
                                        <tr class="transition-all bg-gray-400">
                                            <td class="p-2 whitespace-nowrap">
                                                Total
                                            </td>
                                            <td class="p-2 whitespace-nowrap">
                                                <input type="number" step="any" min="0" value="{{ array_sum(array_column($journals,'debit')) }}" class="block w-full p-2 leading-tight text-right text-gray-700 border border-gray-200 rounded appearance-none bg-gray-50 focus:outline-none focus:bg-white focus:border-gray-500"
                                                    disabled />
                                            </td>
                                            <td class="p-2 whitespace-nowrap">
                                                <input type="number" step="any" min="0" value="{{ array_sum(array_column($journals,'credit')) }}"  class="block w-full p-2 leading-tight text-right text-gray-700 border border-gray-200 rounded appearance-none bg-gray-50 focus:outline-none focus:bg-white focus:border-gray-500"
                                                    disabled />
                                            </td>
                                            <td class="p-2 whitespace-nowrap">

                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <div class="w-full p-3">
                                    @error('journals')<p class="text-xs italic text-red-500">{{ $message }}</p>@enderror
                                        <button type="button" class="px-6 py-2 leading-5 text-white transition-colors duration-200 transform bg-gray-700 rounded-md hover:bg-gray-600 focus:outline-none focus:bg-gray-600" wire:click.prevent="addJournal">+ Add Another Account</button>
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
</div>
