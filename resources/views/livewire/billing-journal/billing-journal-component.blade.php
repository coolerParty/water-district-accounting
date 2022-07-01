<div>
    @section('title', 'Billing Journal')
    <!-- Main content header -->
    <div
        class="flex flex-col items-start justify-between pb-6 space-y-4 border-b lg:items-center lg:space-y-0 lg:flex-row">
        <h1 class="text-2xl font-semibold whitespace-nowrap">Billing Journal</h1>
        @can('billing-create')
            <a href="{{ route('billingjournal.create') }}"
                class="inline-flex items-center px-6 py-2 space-x-1 text-white bg-purple-600 rounded-md shadow hover:bg-opacity-95">
                <span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </span>
                <span>Add New</span>
            </a>
        @endcan
    </div>
    <div class="flex flex-col mt-6">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                <div class="overflow-hidden border-b border-gray-200 rounded-md shadow-md">
                    <table class="min-w-full overflow-x-scroll divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col"
                                    class="p-2 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                    Date
                                </th>
                                <th scope="col"
                                    class="p-2 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                    JEV No
                                </th>
                                <th scope="col"
                                    class="p-2 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                    Zone
                                </th>
                                <th scope="col"
                                    class="p-2 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                    metered_sales
                                </th>
                                <th scope="col"
                                    class="p-2 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                    Particulars
                                </th>
                                <th scope="col" class="p-2">
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
                            @forelse($billings as $billing)
                            <tr class="transition-all hover:bg-gray-100 hover:shadow-lg">
                                <td class="px-2 py-1 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900">{{ $billing->jdate }}</div>
                                </td>
                                <td class="px-2 py-1 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900">{{ $billing->jno }}</div>
                                </td>
                                <td class="px-2 py-1 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900">{{ $billing->zone }}
                                    </div>
                                </td>
                                <td class="px-2 py-1 whitespace-nowrap">
                                    <div class="text-xs text-gray-900">{{ $billing->metered_sales }}</div>
                                </td>
                                <td class="px-2 py-1 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900">{{ $billing->part }}
                                    </div>
                                </td>
                                <td class="px-2 py-1 text-sm font-medium text-right whitespace-nowrap">
                                    @can('billing-edit')
                                    <x-link-success href="{{ route('billingjournal.edit',['id'=>$billing->bid]) }}" >
                                        Edit
                                    </x-link-success>
                                    @can('billing-delete')
                                    @endcan
                                    <x-link-danger href="#" class="btn btn-danger btn-sm text-light"
                                        onclick="confirm('Are you sure, You want to delete this account chart?') || event.stopImmediatePropagation()"
                                        wire:click.prevent="destroy({{ $billing->bid }},{{ $billing->jid }})">
                                        Delete
                                    </x-link-danger>
                                    @endcan
                                </td>
                            </tr>
                            @empty
                            <tr class="transition-all hover:bg-gray-100 hover:shadow-lg">
                                <td colspan="11" class="px-6 py-4 text-center whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900">No Billing Journal Found!</div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <div class="p-4 bg-gray-100">
                        {!! $billings->links() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
