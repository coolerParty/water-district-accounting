<div>
    @section('title', 'General Ledger Report')
    <!-- Main content header -->
    <div
        class="flex flex-col items-start justify-between pb-6 mb-2 space-y-4 border-b lg:items-center lg:space-y-0 lg:flex-row">
        <h1 class="text-lg font-semibold whitespace-nowrap">General Ledger Report</h1>
    </div>
    <div class="max-w-full md:p-4">

        <section class="max-w-md p-6 mx-auto mb-4 bg-white rounded-md shadow-md dark:bg-gray-800">
            <form class="w-full" wire:submit.prevent="printView">
                <div class="flex flex-wrap mb-6 -mx-3">
                    <div class="w-full px-3 mb-6 md:w-1/2 md:mb-0">
                        <label class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase" for="year">
                            Year
                        </label>
                        <input id="year" type="text" value="{{ old('year') }}" wire:model="year" {{ ($showPrint)
                            ? 'disabled' : '' }}
                            class="block w-full px-4 py-3 leading-tight text-gray-700 bg-gray-200 border @error('year') mb-3 border-red-500 @else border-gray-200 focus:border-gray-500 @enderror rounded appearance-none focus:outline-none focus:bg-white">
                        @error('year')<p class="text-xs italic text-red-500">{{ $message }}</p>@enderror
                    </div>
                    <div class="w-full px-3 mb-6 md:w-1/2 md:mb-0">
                        <label class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase" for="month">
                            End
                        </label>
                        <select id="month" wire:model="month" wire:model="month" {{ ($showPrint) ? 'disabled' : '' }}
                            class="block w-full px-4 py-3 leading-tight text-gray-700 bg-gray-200 border @error('month') mb-3 border-red-500 @else border-gray-200 focus:border-gray-500 @enderror rounded appearance-none focus:outline-none focus:bg-white">
                            <option value="" selected>Select Month</option>
                            <option value="1">January</option>
                            <option value="2">February</option>
                            <option value="3">March</option>
                            <option value="4">April</option>
                            <option value="5">May</option>
                            <option value="6">June</option>
                            <option value="7">July</option>
                            <option value="8">August</option>
                            <option value="9">September</option>
                            <option value="10">October</option>
                            <option value="11">November</option>
                            <option value="12">December</option>
                        </select>
                        @error('month')<p class="text-xs italic text-red-500">{{ $message }}</p>@enderror
                    </div>
                </div>
                <div class="flex flex-wrap mb-6 -mx-3">
                    <div class="w-full px-3">
                        <label class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase"
                            for="code">
                            Journal Report
                        </label>
                        <select id="code" wire:model="code" {{ ($showPrint) ? 'disabled' : '' }}
                            class="block w-full px-4 py-3 leading-tight text-gray-700 bg-gray-200 border @error('code') mb-3 border-red-500 @else border-gray-200 focus:border-gray-500 @enderror rounded appearance-none focus:outline-none focus:bg-white">
                            <option value="" selected>Select Account</option>
                            @foreach($accounts as $account)
                            <option value="{{ $account->code }}">{{ $account->code . ' - ' . $account->name }}</option>
                            @endforeach
                        </select>
                        @error('code')<p class="text-xs italic text-red-500">{{ $message }}</p>@enderror
                    </div>
                </div>
                @if($showPrint)
                <div class="flex justify-end mt-6">
                    <x-link-secondary
                        href="{{ route('generalledger.show',['code'=>$code,'year'=>$year,'month'=>$month]) }}"
                        target="_blank">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M6 2a2 2 0 00-2 2v12a2 2 0 002 2h8a2 2 0 002-2V7.414A2 2 0 0015.414 6L12 2.586A2 2 0 0010.586 2H6zm2 10a1 1 0 10-2 0v3a1 1 0 102 0v-3zm2-3a1 1 0 011 1v5a1 1 0 11-2 0v-5a1 1 0 011-1zm4-1a1 1 0 10-2 0v7a1 1 0 102 0V8z"
                                clip-rule="evenodd" />
                        </svg> Print Preview
                    </x-link-secondary>
                    <x-link-secondary class="ml-2"
                        href="{{ route('generalledger.download',['code'=>$code,'year'=>$year,'month'=>$month]) }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm3.293-7.707a1 1 0 011.414 0L9 10.586V3a1 1 0 112 0v7.586l1.293-1.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z"
                                clip-rule="evenodd" />
                        </svg> Download PDF
                    </x-link-secondary>
                </div>
                @endif
                <div class="flex justify-end mt-6">
                    @if($showPrint == false)
                    <button type="submit"
                        class="px-6 py-2 leading-5 text-white transition-colors duration-200 transform bg-gray-700 rounded-md hover:bg-gray-600 focus:outline-none focus:bg-gray-600">Set
                        Report</button>
                    @else
                    <x-link-danger href="#" wire:click="cancel">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Cancel
                    </x-link-danger>
                    @endif
                </div>
            </form>
        </section>
        <div class="max-w-md mx-auto">
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
        </div>
    </div>
</div>
