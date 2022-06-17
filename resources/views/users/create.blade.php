@extends('layouts.front')

@section('content')
@section('title', 'Users Create')
<!-- Main content header -->
<div class="
    flex flex-col
    items-start
    justify-between
    pb-6
    space-y-4
    border-b
    lg:items-center lg:space-y-0 lg:flex-row
    mb-4
    ">
    <h1 class="text-2xl font-semibold whitespace-nowrap">Users Create</h1>
    <a href="{{ route('users.index') }}" class="
            inline-flex
            items-center
            justify-center
            px-4
            py-1
            space-x-1
            bg-gray-200
            rounded-md
            shadow
            hover:bg-opacity-20
        ">
        <span>
            <svg class="w-4 h-4 text-gray-500" viewBox="0 0 16 16" fill="currentColor" aria-hidden="true">
                <path fill-rule="evenodd"
                    d="M8 0C3.58 0 0 3.58 0 8c0 3.54 2.29 6.53 5.47 7.59.4.07.55-.17.55-.38 0-.19-.01-.82-.01-1.49-2.01.37-2.53-.49-2.69-.94-.09-.23-.48-.94-.82-1.13-.28-.15-.68-.52-.01-.53.63-.01 1.08.58 1.23.82.72 1.21 1.87.87 2.33.66.07-.52.28-.87.51-1.07-1.78-.2-3.64-.89-3.64-3.95 0-.87.31-1.59.82-2.15-.08-.2-.36-1.02.08-2.12 0 0 .67-.21 2.2.82.64-.18 1.32-.27 2-.27.68 0 1.36.09 2 .27 1.53-1.04 2.2-.82 2.2-.82.44 1.1.16 1.92.08 2.12.51.56.82 1.27.82 2.15 0 3.07-1.87 3.75-3.65 3.95.29.25.54.73.54 1.48 0 1.07-.01 1.93-.01 2.2 0 .21.15.46.55.38A8.013 8.013 0 0016 8c0-4.42-3.58-8-8-8z">
                </path>
            </svg>
        </span>
        <span>Back</span>
    </a>
</div>


<section class="max-w-4xl p-6 mx-auto bg-white rounded-md shadow-md dark:bg-gray-800">
    <x-jet-validation-errors class="mb-4" />
    <form method="POST" action="{{ route('users.store') }}">
        @csrf
        <div class="mt-4">
            <div>
                <label class="text-gray-700 dark:text-gray-200" for="name">name</label>
                <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus
                    autocomplete="name"
                    class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-200 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 focus:ring-blue-300 focus:ring-opacity-40 dark:focus:border-blue-300 focus:outline-none focus:ring">
            </div>
        </div>

        <div class="mt-4">
            <div>
                <label class="text-gray-700 dark:text-gray-200" for="title">email</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                    autocomplete="email"
                    class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-200 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 focus:ring-blue-300 focus:ring-opacity-40 dark:focus:border-blue-300 focus:outline-none focus:ring">
            </div>
        </div>

        <div class="mt-4">
            <div>
                <label class="text-gray-700 dark:text-gray-200" for="password">password</label>
                <input id="password" type="password" name="password" value="{{ old('new password') }}" required autofocus
                    autocomplete="password"
                    class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-200 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 focus:ring-blue-300 focus:ring-opacity-40 dark:focus:border-blue-300 focus:outline-none focus:ring">
                <x-jet-input-error for="password" class="mt-2" />
            </div>
        </div>

        <div class="mt-4">
            <div>
                <label class="text-gray-700 dark:text-gray-200" for="password_confirmation">password</label>
                <input id="password_confirmation" type="password" name="password_confirmation" value="{{ old('password_confirmation') }}" required autofocus
                    autocomplete="password_confirmation"
                    class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-200 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 focus:ring-blue-300 focus:ring-opacity-40 dark:focus:border-blue-300 focus:outline-none focus:ring">
                <x-jet-input-error for="password_confirmation" class="mt-2" />
            </div>
        </div>

        <div class="mt-4">
            <div class="py-4"><strong>Roles:</strong></div>
                @foreach($roles as $value)
                    <div class="m-1 p-2 border shadow-sm w-full"><label>
                            <input type="checkbox" value="{{ $value->name }}" name="role[]"
                                class="{{ $value->name }} rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 bg-indigo-900">
                            {{ $value->name }}
                        </label>
                    </div>
                @endforeach
        </div>

        <div class="flex justify-end mt-6">
            <button type="submit"
                class="px-6 py-2 leading-5 text-white transition-colors duration-200 transform bg-gray-700 rounded-md hover:bg-gray-600 focus:outline-none focus:bg-gray-600">Save</button>
        </div>
    </form>
</section>

@endsection
