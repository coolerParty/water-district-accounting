<div>
    @section('title', 'All Journal Transaction')
    <!-- Main content header -->
    <div
        class="flex flex-col items-start justify-between pb-6 space-y-4 border-b lg:items-center lg:space-y-0 lg:flex-row">
        <h1 class="text-2xl font-semibold whitespace-nowrap">All Journal Transaction</h1>
        <!-- <a href="https://github.com/Kamona-WD/starter-dashboard-layout" target="_blank" class=" -->
    </div>
    <div class="flex flex-col mt-6">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                <div class="overflow-hidden border-b border-gray-200 rounded-md shadow-md">
                    {{-- search form start --}}
                    <div class="w-full p-5 bg-white shadow">
                        <div>
                            <div class="flex justify-between">

                                <div class="flex-1">
                                    <div class="relative">
                                        <div class="absolute flex items-center h-full ml-2">
                                            <svg class="w-4 h-4 fill-current text-primary-gray-dark" viewBox="0 0 16 16"
                                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M15.8898 15.0493L11.8588 11.0182C11.7869 10.9463 11.6932 10.9088 11.5932 10.9088H11.2713C12.3431 9.74952 12.9994 8.20272 12.9994 6.49968C12.9994 2.90923 10.0901 0 6.49968 0C2.90923 0 0 2.90923 0 6.49968C0 10.0901 2.90923 12.9994 6.49968 12.9994C8.20272 12.9994 9.74952 12.3431 10.9088 11.2744V11.5932C10.9088 11.6932 10.9495 11.7869 11.0182 11.8588L15.0493 15.8898C15.1961 16.0367 15.4336 16.0367 15.5805 15.8898L15.8898 15.5805C16.0367 15.4336 16.0367 15.1961 15.8898 15.0493ZM6.49968 11.9994C3.45921 11.9994 0.999951 9.54016 0.999951 6.49968C0.999951 3.45921 3.45921 0.999951 6.49968 0.999951C9.54016 0.999951 11.9994 3.45921 11.9994 6.49968C11.9994 9.54016 9.54016 11.9994 6.49968 11.9994Z">
                                                </path>
                                            </svg>
                                        </div>
                                        <input wire:model="search" type="search" placeholder="Search"
                                            class="w-full px-8 py-3 text-sm bg-gray-100 border-transparent rounded-md md:w-2/6 focus:border-gray-500 focus:bg-white focus:ring-0" />
                                    </div>
                                </div>

                                <div class="flex">
                                    <select wire:model="perPage"
                                        class="w-full px-8 py-3 text-sm bg-gray-100 border-transparent rounded-md focus:border-gray-500 focus:bg-white focus:ring-0">
                                        <option value="10">10 Per Page</option>
                                        <option value="30">30 Per page</option>
                                        <option value="50">50 Per Page</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- search form end --}}
                    <table class="min-w-full overflow-x-scroll divide-y divide-gray-200">
                        <x-link-danger class="p-2 m-2 cursor-pointer" wire:click.prevent="deleteSelected" onclick="confirm('Are you sure?') || event.stopImmediatePropagation()"><span class="mr-2">({{ count($selectedJournals) }})</span> Delete Selected</x-link-danger>
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="p-2 text-xs font-medium tracking-wider text-left text-gray-500 uppercase cursor-pointer">
                                    <input type="checkbox" wire:model="selectAll" class="text-indigo-600 bg-indigo-900 border-gray-300 rounded shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                </th>
                                <th scope="col"
                                    class="p-2 text-xs font-medium tracking-wider text-left text-gray-500 uppercase cursor-pointer"
                                    wire:click="sortByColumn('type')">
                                    <div class="flex content-center space-x-4">
                                        <span>Type</span>
                                        @if ($sortColumn == 'type' && $sortDirection == 'desc')
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-indigo-700"
                                            viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M14.707 10.293a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 111.414-1.414L9 12.586V5a1 1 0 012 0v7.586l2.293-2.293a1 1 0 011.414 0z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        @elseif ($sortColumn == 'type' && $sortDirection == 'asc')
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-indigo-700"
                                            viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M5.293 9.707a1 1 0 010-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 01-1.414 1.414L11 7.414V15a1 1 0 11-2 0V7.414L6.707 9.707a1 1 0 01-1.414 0z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        @endif
                                    </div>
                                </th>
                                <th scope="col"
                                    class="p-2 text-xs font-medium tracking-wider text-left text-gray-500 uppercase cursor-pointer"
                                    wire:click="sortByColumn('jv_date')">
                                    <div class="flex content-center space-x-4">
                                        <span>Date</span>
                                        @if ($sortColumn == 'jv_date' && $sortDirection == 'desc')
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-indigo-700"
                                            viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M14.707 10.293a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 111.414-1.414L9 12.586V5a1 1 0 012 0v7.586l2.293-2.293a1 1 0 011.414 0z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        @elseif ($sortColumn == 'jv_date' && $sortDirection == 'asc')
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-indigo-700"
                                            viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M5.293 9.707a1 1 0 010-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 01-1.414 1.414L11 7.414V15a1 1 0 11-2 0V7.414L6.707 9.707a1 1 0 01-1.414 0z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        @endif
                                    </div>
                                </th>
                                <th scope="col"
                                    class="p-2 text-xs font-medium tracking-wider text-left text-gray-500 uppercase cursor-pointer"
                                    wire:click="sortByColumn('jev_no')">
                                    <div class="flex content-center space-x-4">
                                        <span>JEV No</span>
                                        @if ($sortColumn == 'jev_no' && $sortDirection == 'desc')
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-indigo-700"
                                            viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M14.707 10.293a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 111.414-1.414L9 12.586V5a1 1 0 012 0v7.586l2.293-2.293a1 1 0 011.414 0z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        @elseif ($sortColumn == 'jev_no' && $sortDirection == 'asc')
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-indigo-700"
                                            viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M5.293 9.707a1 1 0 010-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 01-1.414 1.414L11 7.414V15a1 1 0 11-2 0V7.414L6.707 9.707a1 1 0 01-1.414 0z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        @endif
                                    </div>
                                </th>
                                <th scope="col"
                                    class="p-2 text-xs font-medium tracking-wider text-left text-gray-500 uppercase cursor-pointer"
                                    wire:click="sortByColumn('particulars')">
                                    <div class="flex content-center space-x-4">
                                        <span>Particulars</span>
                                        @if ($sortColumn == 'particulars' && $sortDirection == 'desc')
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-indigo-700"
                                            viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M14.707 10.293a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 111.414-1.414L9 12.586V5a1 1 0 012 0v7.586l2.293-2.293a1 1 0 011.414 0z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        @elseif ($sortColumn == 'particulars' && $sortDirection == 'asc')
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-indigo-700"
                                            viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M5.293 9.707a1 1 0 010-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 01-1.414 1.414L11 7.414V15a1 1 0 11-2 0V7.414L6.707 9.707a1 1 0 01-1.414 0z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        @endif
                                    </div>
                                </th>
                                <th scope="col" class="p-2">
                                    <span>JEV Report</span>
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
                            @forelse($journals as $journal)
                            <tr class="transition-all hover:bg-gray-100 hover:shadow-lg">
                                <td class="px-2 py-1 whitespace-nowrap"><input type="checkbox" value="{{ $journal->id }}"
                                    class="{{ $journal->jev_no  }} rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 bg-indigo-900"
                                    wire:model="selectedJournals"></td>
                                <td class="px-2 py-1 whitespace-nowrap">
                                    <div class="text-xs font-bold text-gray-900 md:text-sm">
                                        @if($journal->type == 1)
                                        CRJ
                                        @elseif($journal->type == 2)
                                        BJ
                                        @elseif($journal->type == 3)
                                        MSIJ
                                        @elseif($journal->type == 4)
                                        CDJ
                                        @elseif($journal->type == 5)
                                        GJ
                                        @endif
                                    </div>
                                </td>
                                <td class="px-2 py-1 whitespace-nowrap">
                                    <div class="text-xs font-medium text-gray-900 md:text-sm">{{ $journal->jv_date }}
                                    </div>
                                </td>
                                <td class="px-2 py-1 whitespace-nowrap">
                                    <div class="text-xs font-bold text-gray-900 md:text-sm">
                                        {{ $journal->jev_no }}
                                    </div>
                                </td>
                                <td class="px-2 py-1">
                                    <div class="text-xs text-gray-900 md:text-sm">{{ $journal->particulars
                                        }}</div>
                                </td>
                                <td class="px-2 py-1 text-sm font-medium text-right md:whitespace-nowrap">
                                    @if($journal->type == 1)
                                    @can('cash-receipt-journal-jev')
                                    <x-link-secondary href="{{ route('jev.show',['id'=>$journal->id]) }}"
                                        target="_blank">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20"
                                            fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M6 2a2 2 0 00-2 2v12a2 2 0 002 2h8a2 2 0 002-2V7.414A2 2 0 0015.414 6L12 2.586A2 2 0 0010.586 2H6zm2 10a1 1 0 10-2 0v3a1 1 0 102 0v-3zm2-3a1 1 0 011 1v5a1 1 0 11-2 0v-5a1 1 0 011-1zm4-1a1 1 0 10-2 0v7a1 1 0 102 0V8z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </x-link-secondary>
                                    <x-link-secondary href="{{ route('jev.download',['id'=>$journal->id]) }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20"
                                            fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm3.293-7.707a1 1 0 011.414 0L9 10.586V3a1 1 0 112 0v7.586l1.293-1.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </x-link-secondary>
                                    @endcan
                                    @elseif($journal->type == 2)
                                    @can('billing-jev')
                                    <x-link-secondary href="{{ route('jev.show',['id'=>$journal->id]) }}"
                                        target="_blank">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20"
                                            fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M6 2a2 2 0 00-2 2v12a2 2 0 002 2h8a2 2 0 002-2V7.414A2 2 0 0015.414 6L12 2.586A2 2 0 0010.586 2H6zm2 10a1 1 0 10-2 0v3a1 1 0 102 0v-3zm2-3a1 1 0 011 1v5a1 1 0 11-2 0v-5a1 1 0 011-1zm4-1a1 1 0 10-2 0v7a1 1 0 102 0V8z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </x-link-secondary>
                                    <x-link-secondary href="{{ route('jev.download',['id'=>$journal->id]) }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20"
                                            fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm3.293-7.707a1 1 0 011.414 0L9 10.586V3a1 1 0 112 0v7.586l1.293-1.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </x-link-secondary>
                                    @endcan
                                    @elseif($journal->type == 3)
                                    @can('material-journal-jev')
                                    <x-link-secondary href="{{ route('jev.show',['id'=>$journal->id]) }}"
                                        target="_blank">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20"
                                            fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M6 2a2 2 0 00-2 2v12a2 2 0 002 2h8a2 2 0 002-2V7.414A2 2 0 0015.414 6L12 2.586A2 2 0 0010.586 2H6zm2 10a1 1 0 10-2 0v3a1 1 0 102 0v-3zm2-3a1 1 0 011 1v5a1 1 0 11-2 0v-5a1 1 0 011-1zm4-1a1 1 0 10-2 0v7a1 1 0 102 0V8z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </x-link-secondary>
                                    <x-link-secondary href="{{ route('jev.download',['id'=>$journal->id]) }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20"
                                            fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm3.293-7.707a1 1 0 011.414 0L9 10.586V3a1 1 0 112 0v7.586l1.293-1.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </x-link-secondary>
                                    @endcan
                                    @elseif($journal->type == 4)
                                    @can('disbursement-journal-jev')
                                    <x-link-secondary href="{{ route('jev.show',['id'=>$journal->id]) }}"
                                        target="_blank">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20"
                                            fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M6 2a2 2 0 00-2 2v12a2 2 0 002 2h8a2 2 0 002-2V7.414A2 2 0 0015.414 6L12 2.586A2 2 0 0010.586 2H6zm2 10a1 1 0 10-2 0v3a1 1 0 102 0v-3zm2-3a1 1 0 011 1v5a1 1 0 11-2 0v-5a1 1 0 011-1zm4-1a1 1 0 10-2 0v7a1 1 0 102 0V8z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </x-link-secondary>
                                    <x-link-secondary href="{{ route('jev.download',['id'=>$journal->id]) }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20"
                                            fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm3.293-7.707a1 1 0 011.414 0L9 10.586V3a1 1 0 112 0v7.586l1.293-1.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </x-link-secondary>
                                    @endcan
                                    @elseif($journal->type == 5)
                                    @can('general-journal-jev')
                                    <x-link-secondary href="{{ route('jev.show',['id'=>$journal->id]) }}"
                                        target="_blank">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20"
                                            fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M6 2a2 2 0 00-2 2v12a2 2 0 002 2h8a2 2 0 002-2V7.414A2 2 0 0015.414 6L12 2.586A2 2 0 0010.586 2H6zm2 10a1 1 0 10-2 0v3a1 1 0 102 0v-3zm2-3a1 1 0 011 1v5a1 1 0 11-2 0v-5a1 1 0 011-1zm4-1a1 1 0 10-2 0v7a1 1 0 102 0V8z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </x-link-secondary>
                                    <x-link-secondary href="{{ route('jev.download',['id'=>$journal->id]) }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20"
                                            fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm3.293-7.707a1 1 0 011.414 0L9 10.586V3a1 1 0 112 0v7.586l1.293-1.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </x-link-secondary>
                                    @endcan
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr class="transition-all hover:bg-gray-100 hover:shadow-lg">
                                <td colspan="5" class="px-6 py-4 text-center whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900">No Journals Found!</div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <div class="p-4 bg-gray-100">
                        {!! $journals->links() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
