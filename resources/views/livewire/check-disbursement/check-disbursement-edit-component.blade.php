<div>
    @section('title', 'Check Disbursement Journal / Edit / ' . $jev_no)
    <!-- Main content header -->
    <div
        class="flex flex-col items-start justify-between pb-6 mb-2 space-y-4 border-b lg:items-center lg:space-y-0 lg:flex-row">
        <h1 class="text-lg font-semibold whitespace-nowrap">Check Disbursement Journal <span
            class="text-base text-gray-400">/</span> Edit <span
                class="text-base text-gray-400">/</span>
            <span class="text-2xl">{{ $jev_no }}</span>
        </h1>
        <a href="{{ route('checkdisbursementjournal.index') }}"
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
            <form class="w-full" wire:submit.prevent="update">
                <div class="flex flex-wrap mb-6 -mx-3">
                    <div class="w-full px-3 mb-6 md:mb-0">
                        <label class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase"
                            for="jev_date">
                            Jev Date
                        </label>
                        <input id="jev_date" type="date" value="{{ old('jev_date') }}" wire:model="jev_date"
                            class="block w-full px-4 py-3 leading-tight text-gray-700 bg-gray-200 border @error('jev_date') mb-3 border-red-500 @else border-gray-200 focus:border-gray-500 @enderror rounded appearance-none focus:outline-none focus:bg-white">
                        @error('jev_date')<p class="text-xs italic text-red-500">{{ $message }}</p>@enderror
                    </div>
                </div>
                <div class="flex flex-wrap mb-6 -mx-3">
                    <div class="w-full px-3 mb-6 md:w-1/2 md:mb-0">
                        <label class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase" for="jev_no">
                            Jev No
                        </label>
                        <div class="flex flex-wrap space-x-1">
                            <input id="jev_no" type="text" value="{{ old('jev_no') }}" wire:model="jev_no"
                            class="block w-3.5/5 px-4 py-3 leading-tight text-gray-700 bg-gray-200 border @error('jev_no') mb-3 border-red-500 @else border-gray-200 focus:border-gray-500 @enderror rounded appearance-none focus:outline-none focus:bg-white">

                              <x-link-success href="#" wire:click.prevent="getMaxJevNumber" class="w-1.5/5">
                                Jev Number
                            </x-link-success>
                        </div>
                        @error('jev_no')<p class="text-xs italic text-red-500">{{ $message }}</p>@enderror
                    </div>
                    <div class="w-full px-3 mb-6 md:w-1/2 md:mb-0">
                        <label class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase"
                            for="dv_number">
                            DV No
                        </label>
                        <div class="flex flex-wrap space-x-1">
                            <input id="dv_number" type="text" value="{{ old('dv_number') }}" wire:model="dv_number"
                                class="block w-3.5/5 px-4 py-3 leading-tight text-gray-700 bg-gray-200 border @error('dv_number') mb-3 border-red-500 @else border-gray-200 focus:border-gray-500 @enderror rounded appearance-none focus:outline-none focus:bg-white">

                            <x-link-success href="#" wire:click.prevent="getMaxDVNumber" class="w-1.5/5">
                                DV Number
                            </x-link-success>
                        </div>
                        @error('dv_number')<p class="text-xs italic text-red-500">{{ $message }}</p>@enderror
                    </div>
                </div>
                <div class="flex flex-wrap mb-6 -mx-3">
                    <div class="w-full px-3 mb-6 md:w-1/2 md:mb-0">
                        <label class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase" for="payee">
                            Payee
                        </label>
                        <input id="payee" type="text" value="{{ old('payee') }}" placeholder="Payee" wire:model="payee"
                            class="block w-full px-4 py-3 leading-tight text-gray-700 bg-gray-200 border @error('payee') mb-3 border-red-500 @else border-gray-200 focus:border-gray-500 @enderror rounded appearance-none focus:outline-none focus:bg-white">
                        @error('payee')<p class="text-xs italic text-red-500">{{ $message }}</p>@enderror
                    </div>
                    <div class="w-full px-3 mb-6 md:w-1/2 md:mb-0">
                        <label class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase" for="tin_no">
                            TIN / Employee Number
                        </label>
                        <input id="tin_no" type="text" value="{{ old('tin_no') }}" placeholder="TIN / Employee Number"
                            wire:model="tin_no"
                            class="block w-full px-4 py-3 leading-tight text-gray-700 bg-gray-200 border @error('tin_no') mb-3 border-red-500 @else border-gray-200 focus:border-gray-500 @enderror rounded appearance-none focus:outline-none focus:bg-white">
                        @error('tin_no')<p class="text-xs italic text-red-500">{{ $message }}</p>@enderror
                    </div>
                </div>
                <div class="flex flex-wrap mb-6 -mx-3">
                    <div class="w-full px-3 mb-6 md:mb-0">
                        <label class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase" for="address">
                            Address
                        </label>
                        <input id="address" type="text" value="{{ old('address') }}" placeholder="Address"
                            wire:model="address"
                            class="block w-full px-4 py-3 leading-tight text-gray-700 bg-gray-200 border @error('address') mb-3 border-red-500 @else border-gray-200 focus:border-gray-500 @enderror rounded appearance-none focus:outline-none focus:bg-white">
                        @error('address')<p class="text-xs italic text-red-500">{{ $message }}</p>@enderror
                    </div>
                </div>
                <div class="flex flex-wrap mb-6 -mx-3">
                    <div class="w-full px-3 mb-6">
                        <label class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase"
                            for="dvParticulars">
                            DV Particulars
                        </label>
                        <textarea id="dvParticulars" placeholder="Enter DV Particulars" wire:model="dvParticulars"
                            rows="5"
                            class="block w-full px-4 py-3 leading-tight text-gray-700 bg-gray-200 border @error('dvParticulars') mb-3 border-red-500 @else border-gray-200 focus:border-gray-500 @enderror rounded appearance-none focus:outline-none focus:bg-white"></textarea>
                        @error('dvParticulars')<p class="text-xs italic text-red-500">{{ $message }}</p>@enderror
                    </div>
                </div>
                <div class="flex flex-wrap -mx-3">
                    <div class="w-full px-3 mb-6 md:w-2/4">
                        <label class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase"
                            for="check_number">
                            Check Number
                        </label>
                        <input id="check_number" type="text" placeholder="Check Number"
                            value="{{ old('check_number') }}" wire:model="check_number"
                            class="block w-full px-4 py-3 leading-tight text-gray-700 bg-gray-200 border @error('check_number') mb-3 border-red-500 @else border-gray-200 focus:border-gray-500 @enderror rounded appearance-none focus:outline-none focus:bg-white">
                        @error('check_number')<p class="text-xs italic text-red-500">{{ $message }}</p>@enderror
                    </div>
                    <div class="w-full px-3 mb-6 md:w-1/4 md:mb-0">
                        <label class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase"
                            for="check_withdrawn">
                            Check Withdrawn
                        </label>
                        <input id="check_withdrawn" type="checkbox" placeholder="check withdrawn"
                            wire:model="check_withdrawn"
                            class="float-left w-4 h-4 mt-1 mr-2 align-top transition duration-200 bg-white bg-center bg-no-repeat bg-contain border border-gray-300 rounded-sm appearance-none cursor-pointer form-check-input checked:bg-blue-600 checked:border-blue-600 focus:outline-none">
                        <p class="text-xs italic ">Check if has been withdrawn in the bank.</p>
                        @error('check_withdrawn')<p class="text-xs italic text-red-500">{{ $message }}</p>@enderror
                    </div>
                    <div class="w-full px-3 mb-6 md:w-1/4 md:mb-0">
                        <label class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase" for="bank_id">
                            Bank
                        </label>
                        <select id="bank_id" wire:model="bank_id" wire:model="bank_id"
                            class="block w-full px-4 py-3 leading-tight text-gray-700 bg-gray-200 border @error('check_number') mb-3 border-red-500 @else border-gray-200 focus:border-gray-500 @enderror rounded appearance-none focus:outline-none focus:bg-white">
                            <option value="">Select Bank</option>
                            <option value="1">Sample 1</option>
                            @foreach($banks as $bank)
                            <option value="{{ $bank->id }}">{{ $bank->bank_name }}</option>
                            @endforeach
                        </select>
                        @error('bank_id')<p class="text-xs italic text-red-500">{{ $message }}</p>@enderror
                    </div>
                </div>
                <div class="flex flex-wrap -mx-3">
                    <div class="w-full px-3 mb-6 md:w-1/2">
                        <label class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase" for="amount">
                            Amount
                        </label>
                        <input id="amount" type="number" step="any" min="0" placeholder="$0.00"
                            value="{{ old('amount') }}" wire:model="amount"
                            class="block w-full px-4 py-3 leading-tight text-gray-700 bg-gray-200 border @error('amount') mb-3 border-red-500 @else border-gray-200 focus:border-gray-500 @enderror rounded appearance-none focus:outline-none focus:bg-white">
                        @error('amount')<p class="text-xs italic text-red-500">{{ $message }}</p>@enderror
                    </div>
                    <div class="w-full px-3 mb-6 md:w-1/4">
                        <label class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase" for="fpa">
                            F.P.A.
                        </label>
                        <input id="fpa" type="text" placeholder="fpa" wire:model="fpa"
                            class="block w-full px-4 py-3 leading-tight text-gray-700 bg-gray-200 border @error('fpa') mb-3 border-red-500 @else border-gray-200 focus:border-gray-500 @enderror rounded appearance-none focus:outline-none focus:bg-white">
                        @error('fpa')<p class="text-xs italic text-red-500">{{ $message }}</p>@enderror
                    </div>
                    <div class="w-full px-3 mb-6 md:w-1/4 md:mb-0">
                        <label class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase"
                            for="type_of_fund">
                            Type of Fund
                        </label>
                        <select id="type_of_fund" wire:model="type_of_fund" wire:model="type_of_fund"
                            class="block w-full px-4 py-3 leading-tight text-gray-700 bg-gray-200 border @error('type_of_fund') mb-3 border-red-500 @else border-gray-200 focus:border-gray-500 @enderror rounded appearance-none focus:outline-none focus:bg-white">
                            <option value="">Select Type of Fund</option>
                            <option value="general">general Fund</option>
                            <option value="retirement">Retirement Fund</option>
                        </select>
                        @error('type_of_fund')<p class="text-xs italic text-red-500">{{ $message }}</p>@enderror
                    </div>
                </div>
                <div class="flex flex-wrap -mx-3">
                    <div class="w-full px-3 mb-6 md:w-1/6">
                        <input id="mds" type="checkbox" wire:model="mds"
                            class="float-left w-4 h-4 mt-1 mr-2 align-top transition duration-200 bg-white bg-center bg-no-repeat bg-contain border border-gray-300 rounded-sm appearance-none cursor-pointer form-check-input checked:bg-blue-600 checked:border-blue-600 focus:outline-none">
                        <label class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase" for="mds">
                            mds
                        </label>
                        @error('mds')<p class="text-xs italic text-red-500">{{ $message }}</p>@enderror
                    </div>
                    <div class="w-full px-3 mb-6 md:w-1/6 md:mb-0">
                        <input id="commercial" type="checkbox" wire:model="commercial"
                            class="float-left w-4 h-4 mt-1 mr-2 align-top transition duration-200 bg-white bg-center bg-no-repeat bg-contain border border-gray-300 rounded-sm appearance-none cursor-pointer form-check-input checked:bg-blue-600 checked:border-blue-600 focus:outline-none">
                        <label class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase"
                            for="commercial">
                            commercial
                        </label>
                        @error('commercial')<p class="text-xs italic text-red-500">{{ $message }}</p>@enderror
                    </div>
                    <div class="w-full px-3 mb-6 md:w-1/6">
                        <input id="ada" type="checkbox" wire:model="ada"
                            class="float-left w-4 h-4 mt-1 mr-2 align-top transition duration-200 bg-white bg-center bg-no-repeat bg-contain border border-gray-300 rounded-sm appearance-none cursor-pointer form-check-input checked:bg-blue-600 checked:border-blue-600 focus:outline-none">
                        <label class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase" for="ada">
                            ada
                        </label>
                        @error('ada')<p class="text-xs italic text-red-500">{{ $message }}</p>@enderror
                    </div>
                    <div class="w-full px-3 mb-6 md:w-1/6 md:mb-0">
                        <input id="cash_in_available" type="checkbox" wire:model="cash_in_available"
                            class="float-left w-4 h-4 mt-1 mr-2 align-top transition duration-200 bg-white bg-center bg-no-repeat bg-contain border border-gray-300 rounded-sm appearance-none cursor-pointer form-check-input checked:bg-blue-600 checked:border-blue-600 focus:outline-none">
                        <label class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase"
                            for="cash_in_available">
                            cash in available
                        </label>
                        @error('cash_in_available')<p class="text-xs italic text-red-500">{{ $message }}</p>@enderror
                    </div>
                    <div class="w-full px-3 mb-6 md:w-1/6 md:mb-0">
                        <input id="subject_to_ada" type="checkbox" wire:model="subject_to_ada"
                            class="float-left w-4 h-4 mt-1 mr-2 align-top transition duration-200 bg-white bg-center bg-no-repeat bg-contain border border-gray-300 rounded-sm appearance-none cursor-pointer form-check-input checked:bg-blue-600 checked:border-blue-600 focus:outline-none">
                        <label class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase"
                            for="subject_to_ada">
                            subject to ada
                        </label>
                        @error('subject_to_ada')<p class="text-xs italic text-red-500">{{ $message }}</p>@enderror
                    </div>
                    <div class="w-full px-3 mb-6 md:w-1/6 md:mb-0">
                        <input id="others" type="checkbox" wire:model="others"
                            class="float-left w-4 h-4 mt-1 mr-2 align-top transition duration-200 bg-white bg-center bg-no-repeat bg-contain border border-gray-300 rounded-sm appearance-none cursor-pointer form-check-input checked:bg-blue-600 checked:border-blue-600 focus:outline-none">
                        <label class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase" for="others">
                            others
                        </label>
                        @error('others')<p class="text-xs italic text-red-500">{{ $message }}</p>@enderror
                    </div>
                </div>
                <div class="flex flex-wrap mb-6 -mx-3">
                    <div class="w-full px-3 mb-6">
                        <label class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase"
                            for="particulars">
                            Particulars
                        </label>
                        <textarea id="particulars" placeholder="Enter Particulars" wire:model="particulars" rows="5"
                            class="block w-full px-4 py-3 leading-tight text-gray-700 bg-gray-200 border @error('particulars') mb-3 border-red-500 @else border-gray-200 focus:border-gray-500 @enderror rounded appearance-none focus:outline-none focus:bg-white"></textarea>
                        @error('particulars')<p class="text-xs italic text-red-500">{{ $message }}</p>@enderror
                    </div>
                </div>
                <div class="flex justify-end mt-6">
                    <button type="submit"
                        class="px-6 py-2 leading-5 text-white transition-colors duration-200 transform bg-gray-700 rounded-md hover:bg-gray-600 focus:outline-none focus:bg-gray-600">Save</button>
                </div>
            </form>
            <div class="flex flex-wrap mb-6 -mx-3">
                <div class="w-full px-3">
                    <div class="card">
                        <div class="card-header">
                            Journal Entry Vouchers
                        </div>
                        <!-- flash message Start -->
                        @if(Session::has('create-success-transaction'))
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

                                            <p class="mx-3">{{ Session::get('create-success-transaction') }}</p>
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
                        @if(Session::has('update-success-transaction'))
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

                                            <p class="mx-3">{{ Session::get('update-success-transaction') }}</p>
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
                        @if(Session::has('delete-success-transaction'))
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

                                            <p class="mx-3">{{ Session::get('delete-success-transaction') }}</p>
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
                                            class="p-3 text-xs font-medium tracking-wider text-gray-500 uppercase selection:text-center">
                                            credit
                                        </th>
                                        <th scope="col"
                                            class="p-3 text-xs font-medium tracking-wider text-center text-gray-500 uppercase">
                                            Action
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach ($transactions as $transaction)
                                    @if (
                                    ($enableAdd == false && $enableEdit == false)
                                    ||
                                    ($enableAdd == true && $enableEdit == false)
                                    ||
                                    ($enableAdd == false && $enableEdit == true && $transaction_id !=
                                    $transaction->id)
                                    )
                                    <tr class="transition-all hover:bg-gray-100">

                                        <td class="p-2 whitespace-nowrap">
                                            <div class="text-sm font-medium text-gray-900">{{
                                                $transaction->accountchart->code }}</div>
                                        </td>
                                        <td class="p-2 text-right whitespace-nowrap">
                                            <div class="text-sm font-medium text-gray-900">{{ number_format($transaction->debit,2) }}
                                            </div>
                                        </td>
                                        <td class="p-2 text-right whitespace-nowrap">
                                            <div class="text-sm font-medium text-gray-900">{{ number_format($transaction->credit,2) }}</div>
                                        </td>
                                        <td class="p-2 text-right whitespace-nowrap">
                                            @can('user-edit')
                                            <x-link-success href="#"
                                                wire:click.prevent="showEditForm('{{ $transaction->id }}')">
                                                Edit
                                            </x-link-success>
                                            @can('user-delete')
                                            @endcan
                                            <x-link-danger href="#" class="btn btn-danger btn-sm text-light"
                                                onclick="confirm('Are you sure, You want to delete this account?') || event.stopImmediatePropagation()"
                                                wire:click.prevent="removeTransaction({{ $transaction->id }})">
                                                Delete
                                            </x-link-danger>
                                            @endcan
                                        </td>
                                    </tr>

                                    @else
                                    <tr class="transition-all hover:bg-gray-100">

                                        <td class="p-2 whitespace-nowrap">
                                            <select wire:model="accountCode"
                                                class="block w-full p-2 leading-tight text-gray-700 bg-gray-200 border border-gray-200 rounded appearance-none focus:outline-none focus:bg-white focus:border-gray-500">
                                                <option value="">Select Account</option>
                                                @foreach($accounts as $account)
                                                <option value="{{ $account->id }}">{{ $account->code . ' - ' .
                                                    $account->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('accountCode')<p class="text-xs italic text-red-500">{{ $message
                                                }}</p>@enderror
                                        </td>
                                        <td class="p-2 whitespace-nowrap">
                                            <input type="number" step="any"
                                                class="block w-full p-2 leading-tight text-right text-gray-700 bg-gray-200 border border-gray-200 rounded appearance-none focus:outline-none focus:bg-white focus:border-gray-500"
                                                wire:model="debit" />
                                            @error('debit')<p class="text-xs italic text-red-500">{{ $message }}</p>
                                            @enderror
                                        </td>
                                        <td class="p-2 whitespace-nowrap">
                                            <input type="number" step="any"
                                                class="block w-full p-2 leading-tight text-right text-gray-700 bg-gray-200 border border-gray-200 rounded appearance-none focus:outline-none focus:bg-white focus:border-gray-500"
                                                wire:model="credit" />
                                            @error('credit')<p class="text-xs italic text-red-500">{{ $message }}
                                            </p>@enderror
                                        </td>
                                        <td class="p-2 text-right whitespace-nowrap">
                                            <form wire:submit.prevent="updateTransaction">
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
                                    @endforeach
                                    @if($enableAdd == true)
                                    <tr class="transition-all hover:bg-gray-100">

                                        <td class="p-2 whitespace-nowrap">
                                            <select wire:model="accountCode"
                                                class="block w-full p-2 leading-tight text-gray-700 bg-gray-200 border border-gray-200 rounded appearance-none focus:outline-none focus:bg-white focus:border-gray-500">
                                                <option value="">Select Account</option>
                                                @foreach($accounts as $account)
                                                <option value="{{ $account->id }}">{{ $account->code . ' - ' .
                                                    $account->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('accountCode')<p class="text-xs italic text-red-500">{{ $message
                                                }}</p>@enderror
                                        </td>
                                        <td class="p-2 whitespace-nowrap">
                                            <input type="number" step="any"
                                                class="block w-full p-2 leading-tight text-right text-gray-700 bg-gray-200 border border-gray-200 rounded appearance-none focus:outline-none focus:bg-white focus:border-gray-500"
                                                wire:model="debit" />
                                            @error('debit')<p class="text-xs italic text-red-500">{{ $message }}</p>
                                            @enderror
                                        </td>
                                        <td class="p-2 whitespace-nowrap">
                                            <input type="number" step="any"
                                                class="block w-full p-2 leading-tight text-right text-gray-700 bg-gray-200 border border-gray-200 rounded appearance-none focus:outline-none focus:bg-white focus:border-gray-500"
                                                wire:model="credit" />
                                            @error('credit')<p class="text-xs italic text-red-500">{{ $message }}
                                            </p>@enderror
                                        </td>
                                        <td class="p-2 text-right whitespace-nowrap">
                                            <form wire:submit.prevent="addTransaction">
                                                @can('user-edit')
                                                <button type="submit"
                                                    class="px-6 py-2 leading-5 text-white transition-colors duration-200 transform bg-gray-700 rounded-md hover:bg-gray-600 focus:outline-none focus:bg-gray-600">Add</button>
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
                                    <tr class="transition-all bg-gray-400">
                                        <td class="p-2 whitespace-nowrap">
                                            Total
                                        </td>
                                        <td class="p-2 whitespace-nowrap">
                                            <p
                                                class="block w-full p-2 leading-tight text-right text-gray-700 border border-gray-200 rounded appearance-none bg-gray-50 focus:outline-none focus:bg-white focus:border-gray-500"
                                                >{{ number_format($transactions->sum('debit'),2) }}</p>
                                        </td>
                                        <td class="p-2 whitespace-nowrap">
                                            <p
                                                class="block w-full p-2 leading-tight text-right text-gray-700 border border-gray-200 rounded appearance-none bg-gray-50 focus:outline-none focus:bg-white focus:border-gray-500"
                                                >{{ number_format($transactions->sum('credit'),2) }}</p>
                                        </td>
                                        <td class="p-2 whitespace-nowrap">

                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            @if(
                                ($enableAdd == false && $enableEdit == false)
                                ||
                                ($enableAdd == true && $enableEdit == false)
                            )
                            <div class="w-full p-3">
                                <button type="button"
                                    class="px-6 py-2 leading-5 text-white transition-colors duration-200 transform bg-gray-700 rounded-md hover:bg-gray-600 focus:outline-none focus:bg-gray-600"
                                    wire:click.prevent="showAddTransaction">+ Add Another Account</button>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>