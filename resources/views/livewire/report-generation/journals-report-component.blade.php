<div>
    @section('title', 'Journals Report')
    <!-- Main content header -->
    <div
        class="flex flex-col items-start justify-between pb-6 mb-2 space-y-4 border-b lg:items-center lg:space-y-0 lg:flex-row">
        <h1 class="text-lg font-semibold whitespace-nowrap">Journals Report</h1>
        <!-- <a href="{{ route('materialissuedjournal.index') }}"
            class="inline-flex items-center px-6 py-2 space-x-1 text-white bg-purple-600 rounded-md shadow hover:bg-opacity-95">
            <span>
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M11 15l-3-3m0 0l3-3m-3 3h8M3 12a9 9 0 1118 0 9 9 0 01-18 0z" />
                </svg>
            </span>
            <span>Back</span>
        </a> -->
    </div>
    <div class="max-w-full md:p-4">

        <section class="max-w-md p-6 mx-auto mb-4 bg-white rounded-md shadow-md dark:bg-gray-800">
            <!-- flash message Start -->
            @if(Session::has('create-success'))
            <div x-data="{ msg:'true'}" class="mb-5">
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
                                <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
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
            <div x-data="{ msg:'true'}" class="mb-5">
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
                                <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
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
            <div x-data="{ msg:'true'}" class="mb-5">
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
                                <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
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
            <form class="w-full" wire:submit.prevent="printView">
                <div class="flex flex-wrap mb-6 -mx-3">
                    <div class="w-full px-3 mb-6 md:w-1/2 md:mb-0">
                        <label class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase"
                            for="date_start">
                            Start
                        </label>
                        <input id="date_start" type="date" value="{{ old('date_start') }}" wire:model="date_start"
                            class="block w-full px-4 py-3 leading-tight text-gray-700 bg-gray-200 border @error('date_start') mb-3 border-red-500 @else border-gray-200 focus:border-gray-500 @enderror rounded appearance-none focus:outline-none focus:bg-white">
                        @error('date_start')<p class="text-xs italic text-red-500">{{ $message }}</p>@enderror
                    </div>
                    <div class="w-full px-3 mb-6 md:w-1/2 md:mb-0">
                        <label class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase"
                            for="date_end">
                            End
                        </label>
                        <input id="date_end" type="date" value="{{ old('date_end') }}" wire:model="date_end"
                            class="block w-full px-4 py-3 leading-tight text-gray-700 bg-gray-200 border @error('date_end') mb-3 border-red-500 @else border-gray-200 focus:border-gray-500 @enderror rounded appearance-none focus:outline-none focus:bg-white">
                        @error('date_end')<p class="text-xs italic text-red-500">{{ $message }}</p>@enderror
                    </div>
                </div>
                <div class="flex flex-wrap mb-6 -mx-3">
                    <div class="w-full px-3">
                        <label class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase" for="journalType">
                            Journal Report
                        </label>
                        <select id="journalType" wire:model="journalType" wire:model="journalType"
                            class="block w-full px-4 py-3 leading-tight text-gray-700 bg-gray-200 border @error('journalType') mb-3 border-red-500 @else border-gray-200 focus:border-gray-500 @enderror rounded appearance-none focus:outline-none focus:bg-white">
                            <option value="">Select Journal Report</option>
                            <option value="1">Cash Receipt Journal</option>
                            <option value="2">Billing Journal</option>
                            <option value="3">Material Stock Issued Journal</option>
                            <option value="4">Check Disbursement Journal</option>
                            <option value="5">General Journal</option>
                        </select>
                        @error('journalType')<p class="text-xs italic text-red-500">{{ $message }}</p>@enderror
                    </div>
                </div>
                <div class="flex flex-wrap mb-6 -mx-3">
                    <div class="w-full px-3">
                        <label class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase" for="option">
                            Option
                        </label>
                        <select id="option" wire:model="option" wire:model="option"
                            class="block w-full px-4 py-3 leading-tight text-gray-700 bg-gray-200 border @error('option') mb-3 border-red-500 @else border-gray-200 focus:border-gray-500 @enderror rounded appearance-none focus:outline-none focus:bg-white">
                            <option value="">Select Report Preview / Download PDF</option>
                            <option value="1">Report Preview</option>
                            <option value="2">Download PDF</option>
                        </select>
                        @error('option')<p class="text-xs italic text-red-500">{{ $message }}</p>@enderror
                    </div>
                </div>
                <div class="flex justify-end mt-6">
                    <button type="submit"
                        class="px-6 py-2 leading-5 text-white transition-colors duration-200 transform bg-gray-700 rounded-md hover:bg-gray-600 focus:outline-none focus:bg-gray-600">Print View</button>
                </div>
            </form>
        </section>
    </div>
</div>
