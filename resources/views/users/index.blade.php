@extends('layouts.front')

@section('content')
@section('title', 'Users')
<!-- Main content header -->
<div class="flex flex-col items-start justify-between pb-6 space-y-4 border-b lg:items-center lg:space-y-0 lg:flex-row">
    <h1 class="text-2xl font-semibold whitespace-nowrap">Users</h1>
    <!-- <a href="https://github.com/Kamona-WD/starter-dashboard-layout" target="_blank" class=" -->
    @can('user-create')
    <a href="{{ route('users.create') }}" class="inline-flex items-center justify-center px-4 py-1 space-x-1 bg-gray-200 rounded-md shadow hover:bg-opacity-20">
        <span>
            <svg class="w-4 h-4 text-gray-500" viewBox="0 0 16 16" fill="currentColor" aria-hidden="true">
                <path fill-rule="evenodd"
                    d="M8 0C3.58 0 0 3.58 0 8c0 3.54 2.29 6.53 5.47 7.59.4.07.55-.17.55-.38 0-.19-.01-.82-.01-1.49-2.01.37-2.53-.49-2.69-.94-.09-.23-.48-.94-.82-1.13-.28-.15-.68-.52-.01-.53.63-.01 1.08.58 1.23.82.72 1.21 1.87.87 2.33.66.07-.52.28-.87.51-1.07-1.78-.2-3.64-.89-3.64-3.95 0-.87.31-1.59.82-2.15-.08-.2-.36-1.02.08-2.12 0 0 .67-.21 2.2.82.64-.18 1.32-.27 2-.27.68 0 1.36.09 2 .27 1.53-1.04 2.2-.82 2.2-.82.44 1.1.16 1.92.08 2.12.51.56.82 1.27.82 2.15 0 3.07-1.87 3.75-3.65 3.95.29.25.54.73.54 1.48 0 1.07-.01 1.93-.01 2.2 0 .21.15.46.55.38A8.013 8.013 0 0016 8c0-4.42-3.58-8-8-8z">
                </path>
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
                                class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                Title
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                Roles
                            </th>
                            <th scope="col" class="relative px-6 py-3">
                                <span class="sr-only">Edit</span>
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
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($users as $user)
                        <tr class="transition-all hover:bg-gray-100 hover:shadow-lg">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">{{ $user->name }}</div>
                            </td>
                            <td class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                                @foreach($user->roles as $role)
                                <span class="px-3 py-1 space-x-1 text-white bg-indigo-500 rounded">{{ $role->name
                                    }}</span>
                                @endforeach
                            </td>
                            <td class="px-6 py-4 text-sm font-medium text-right whitespace-nowrap">
                                @can('user-edit')
                                <x-link-success href="{{ route('users.edit', $user) }}" class="">Edit
                                </x-link-success>
                                @endcan
                                @can('user-delete')
                                <form method="POST" action="{{ route('users.destroy', $user) }}" class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <x-jet-danger-button type="submit" onclick="return confirm('Are you sure?')">
                                        Delete</x-jet-danger-button>
                                </form>
                                @endcan
                            </td>
                        </tr>
                        @empty
                        <tr class="transition-all hover:bg-gray-100 hover:shadow-lg">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">No Role Found</div>
                            </td>
                            <td></td>
                            <td class="px-6 py-4 text-sm font-medium text-right whitespace-nowrap">
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="p-4">
                    {!! $users->links() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
