@extends('layouts.front')

@section('content')
<div>
    @section('title', 'Dashboard')
    <!-- header Start -->
    <!-- Code block starts -->
    <div class="my-6 lg:my-12 container px-6 mx-auto flex flex-col md:flex-row items-start md:items-center justify-between pb-4 border-b border-gray-300">
        <div>
            <h4 class="text-2xl font-bold leading-tight text-gray-800 dark:text-gray-100">@yield('title')</h4>
        </div>
    </div>
    <!-- Code block ends -->
    <!-- header End -->
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <!-- <x-jet-welcome /> -->
            </div>
        </div>
    </div>
</div>
@endsection
