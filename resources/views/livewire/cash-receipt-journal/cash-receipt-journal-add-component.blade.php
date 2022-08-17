<div>
    @section('title', 'Cash Receipt Journal / Create')
    <!-- Main content header -->
    <div
        class="flex flex-col items-start justify-between pb-6 mb-2 space-y-4 border-b lg:items-center lg:space-y-0 lg:flex-row">
        <h1 class="text-lg font-semibold whitespace-nowrap">Cash Receipt Journal <span class="text-base text-gray-400">/</span>
            <span class="text-2xl">Create</span>
        </h1>
        <a href="{{ route('cashreceiptjournal.index') }}"
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
                    <div class="w-full px-3 md:w-1/2">
                        <label class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase"
                            for="official_receipt">
                            official receipt
                        </label>
                        <input id="official_receipt" type="text" placeholder="#000-0000"
                            value="{{ old('official_receipt') }}" wire:model="official_receipt"
                            class="block w-full px-4 py-3 leading-tight text-gray-700 bg-gray-200 border @error('official_receipt') mb-3 border-red-500 @else border-gray-200 focus:border-gray-500 @enderror rounded appearance-none focus:outline-none focus:bg-white">
                        @error('official_receipt')<p class="text-xs italic text-red-500">{{ $message }}</p>@enderror
                    </div>
                </div>
                <div class="flex flex-wrap mb-6 -mx-3">
                    <div class="w-full px-3 mb-6 md:w-1/2 md:mb-0">
                        <label class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase"
                            for="a_receipt">
                            acknowledgement Receipt
                        </label>
                        <input id="a_receipt" type="text" placeholder="Enter company / name" wire:model="a_receipt"
                            class="block w-full px-4 py-3 leading-tight text-gray-700 bg-gray-200 border @error('a_receipt') mb-3 border-red-500 @else border-gray-200 focus:border-gray-500 @enderror rounded appearance-none focus:outline-none focus:bg-white">
                        @error('a_receipt')<p class="text-xs italic text-red-500">{{ $message }}</p>@enderror
                    </div>
                    <div class="w-full px-3 md:w-1/2">
                        <label class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase"
                            for="cod_prev_day">
                            Cash on Hand Previous Day
                        </label>
                        <input id="cod_prev_day" type="number" step="any" placeholder="0.00"
                            wire:model="cod_prev_day"
                            class="text-right block w-full px-4 py-3 leading-tight text-gray-700 bg-gray-200 border @error('cod_prev_day') mb-3 border-red-500 @else border-gray-200 focus:border-gray-500 @enderror rounded appearance-none focus:outline-none focus:bg-white">
                        @error('cod_prev_day')<p class="text-xs italic text-red-500">{{ $message }}</p>@enderror
                    </div>
                </div>
                <div class="flex flex-wrap mb-6 -mx-3">
                    <div class="w-full px-3 mb-6 md:w-1/4 md:mb-0">
                        <label class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase" for="current">
                            Current
                        </label>
                        <input id="current" type="number" step="any" placeholder="0.00" wire:model="current"
                            class="text-right block w-full px-4 py-3 leading-tight text-gray-700 bg-gray-200 border @error('current') mb-3 border-red-500 @else border-gray-200 focus:border-gray-500 @enderror rounded appearance-none focus:outline-none focus:bg-white">
                        @error('current')<p class="text-xs italic text-red-500">{{ $message }}</p>@enderror
                    </div>
                    <div class="w-full px-3 mb-6 md:w-1/4 md:mb-0">
                        <label class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase" for="penalty">
                            penalty
                        </label>
                        <input id="penalty" type="number" step="any" placeholder="0.00" wire:model="penalty"
                            class="text-right block w-full px-4 py-3 leading-tight text-gray-700 bg-gray-200 border @error('penalty') mb-3 border-red-500 @else border-gray-200 focus:border-gray-500 @enderror rounded appearance-none focus:outline-none focus:bg-white">
                        @error('penalty')<p class="text-xs italic text-red-500">{{ $message }}</p>@enderror
                    </div>
                    <div class="w-full px-3 mb-6 md:w-1/4 md:mb-0">
                        <label class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase"
                            for="arrears_cy">
                            Arrears CY
                        </label>
                        <input id="arrears_cy" type="number" step="any" placeholder="0.00"
                            wire:model="arrears_cy"
                            class="text-right block w-full px-4 py-3 leading-tight text-gray-700 bg-gray-200 border @error('arrears_cy') mb-3 border-red-500 @else border-gray-200 focus:border-gray-500 @enderror rounded appearance-none focus:outline-none focus:bg-white">
                        @error('arrears_cy')<p class="text-xs italic text-red-500">{{ $message }}</p>@enderror
                    </div>
                    <div class="w-full px-3 mb-6 md:w-1/4 md:mb-0">
                        <label class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase"
                            for="arrears_py">
                            Arrears PY
                        </label>
                        <input id="arrears_py" type="number" step="any" placeholder="0.00"
                            wire:model="arrears_py"
                            class="text-right block w-full px-4 py-3 leading-tight text-gray-700 bg-gray-200 border @error('arrears_py') mb-3 border-red-500 @else border-gray-200 focus:border-gray-500 @enderror rounded appearance-none focus:outline-none focus:bg-white">
                        @error('arrears_py')<p class="text-xs italic text-red-500">{{ $message }}</p>@enderror
                    </div>
                </div>
                <div class="flex flex-wrap mb-6 -mx-3">
                    <div class="w-full px-3">
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
                                                class="p-3 text-xs font-medium tracking-wider text-left text-center text-gray-500 uppercase">
                                                debit
                                            </th>
                                            <th scope="col"
                                                class="p-3 text-xs font-medium tracking-wider text-left text-center text-gray-500 uppercase">
                                                credit
                                            </th>
                                            <th scope="col"
                                                class="p-3 text-xs font-medium tracking-wider text-left text-center text-gray-500 uppercase">
                                                Action
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        @foreach ($journals as $index => $jev)
                                            <tr class="transition-all hover:bg-gray-100">
                                                <td class="p-2">
                                                    <select name="journals[{{ $index }}][accountCode]"
                                                        wire:model="journals.{{ $index }}.accountCode" class="block w-full p-2 text-sm leading-tight text-gray-700 bg-gray-200 border border-gray-200 rounded appearance-none focus:outline-none focus:bg-white focus:border-gray-500">
                                                        <option value="">Select Account</option>
                                                        @foreach($accounts as $account)
                                                        <option value="{{ $account->id }}">{{ $account->code . ' - ' . $account->name }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('journals.{{ $index }}.accountCode')<p class="text-xs italic text-red-500">{{ $message }}</p>@enderror
                                                </td>
                                                <td class="p-2 w-50 whitespace-nowrap">
                                                    <input type="number" step="any" name="journals[{{ $index }}][debit]" class="block w-full p-2 text-sm leading-tight text-right text-gray-700 bg-gray-200 border border-gray-200 rounded appearance-none focus:outline-none focus:bg-white focus:border-gray-500 "
                                                        wire:model="journals.{{ $index }}.debit" />
                                                        @error('journals.{{ $index }}.debit')<p class="text-xs italic text-red-500">{{ $message }}</p>@enderror
                                                </td>
                                                <td class="p-2 w-50 whitespace-nowrap">
                                                    <input type="number" step="any"  name="subTasks[{{ $index }}][credit]" class="block w-full p-2 text-sm leading-tight text-right text-gray-700 bg-gray-200 border border-gray-200 rounded appearance-none focus:outline-none focus:bg-white focus:border-gray-500 "
                                                        wire:model="journals.{{ $index }}.credit" />
                                                        @error('journals.{{ $index }}.credit')<p class="text-xs italic text-red-500">{{ $message }}</p>@enderror
                                                </td>
                                                <td class="p-2 whitespace-nowrap">
                                                    <x-link-danger href="#" wire:click.prevent="removeJournal({{ $index }})" class="btn btn-danger text-light">Delete</x-link-danger>
                                                </td>
                                            </tr>
                                        @endforeach
                                        <tr class="transition-all bg-gray-400">
                                            <td class="p-2 text-sm whitespace-nowrap ">
                                                Total
                                            </td>
                                            <td class="p-2 whitespace-nowrap">
                                                <input type="number" step="any" value="{{ array_sum(array_column($journals,'debit')) }}" class="block w-full p-2 text-sm leading-tight text-right text-gray-700 border border-gray-200 rounded appearance-none bg-gray-50 focus:outline-none focus:bg-white focus:border-gray-500"
                                                    disabled />
                                            </td>
                                            <td class="p-2 whitespace-nowrap">
                                                <input type="number" step="any" value="{{ array_sum(array_column($journals,'credit')) }}"  class="block w-full p-2 text-sm leading-tight text-right text-gray-700 border border-gray-200 rounded appearance-none bg-gray-50 focus:outline-none focus:bg-white focus:border-gray-500"
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
