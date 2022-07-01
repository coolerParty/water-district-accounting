<div>
    @section('title', 'Bank / Edit / '. $bank_name)
    <!-- Main content header -->
    <div
        class="flex flex-col items-start justify-between pb-6 mb-2 space-y-4 border-b lg:items-center lg:space-y-0 lg:flex-row">
        <h1 class="text-lg font-semibold whitespace-nowrap">Bank <span class="text-base text-gray-400">/</span> Edit <span class="text-base text-gray-400">/</span>
            <span class="text-2xl">{{ $bank_name }}</span></h1>
        <a href="{{ route('bank.index') }}"
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
    <div class="max-w-full max-h-screen md:bg-gray-300 md:p-4">

        <section class="max-w-4xl p-6 mx-auto bg-white rounded-md shadow-md dark:bg-gray-800">
            <x-jet-validation-errors class="mb-4" />
            <form wire:submit.prevent="update">

                <div class="mt-4">
                    <div>
                        <label class="text-gray-700 dark:text-gray-200" for="seq_no">seq no</label>
                        <input id="seq_no" type="number" min="0" name="seq_no" value="{{ old('seq_no') }}" wire:model="seq_no"
                            required autofocus autocomplete="seq_no"
                            class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-200 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 focus:ring-blue-300 focus:ring-opacity-40 dark:focus:border-blue-300 focus:outline-none focus:ring">
                    </div>
                </div>

                <div class="mt-4">
                    <div>
                        <label class="text-gray-700 dark:text-gray-200" for="bank_name">name</label>
                        <input id="bank_name" type="text" name="bank_name" value="{{ old('bank_name') }}" wire:model="bank_name"
                            required autofocus autocomplete="bank_name"
                            class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-200 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 focus:ring-blue-300 focus:ring-opacity-40 dark:focus:border-blue-300 focus:outline-none focus:ring">
                    </div>
                </div>

                <div class="mt-4">
                    <div>
                        <label class="text-gray-700 dark:text-gray-200" for="desc_name_brs">desc name</label>
                        <input id="desc_name_brs" type="text" name="desc_name_brs" value="{{ old('desc_name_brs') }}" wire:model="desc_name_brs" required
                            autofocus autocomplete="desc_name_brs"
                            class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-200 rounded-md shadow-sm dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 focus:ring-blue-300 focus:ring-opacity-40 dark:focus:border-blue-300 focus:outline-none focus:ring">
                    </div>
                </div>

                <div class="mt-4">
                    <div>
                        <label class="text-gray-700 dark:text-gray-200" for="acct_number">acct number</label>
                        <input id="acct_number" type="text" name="acct_number" value="{{ old('acct_number') }}" wire:model="acct_number" required
                            autofocus autocomplete="acct_number"
                            class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-200 rounded-md shadow-sm dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 focus:ring-blue-300 focus:ring-opacity-40 dark:focus:border-blue-300 focus:outline-none focus:ring">
                    </div>
                </div>

                <div class="flex justify-end mt-6">
                    <button type="submit"
                        class="px-6 py-2 leading-5 text-white transition-colors duration-200 transform bg-gray-700 rounded-md hover:bg-gray-600 focus:outline-none focus:bg-gray-600">Update</button>
                </div>
            </form>
        </section>
    </div>
</div>
