<!DOCTYPE html>
<html class="w-full h-full" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield('title')</title>
        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">

        @livewireStyles

        <!-- Scripts -->
        <script src="{{ mix('js/app.js') }}" defer></script>
    </head>
    <body class="font-sans antialiased w-full h-full">
        <div class="w-full h-full bg-gray-100">
            <x-navbar></x-navbar>

            <!-- Page Content -->
            <main>
                @yield('content')
            </main>
        </div>

        @stack('modals')

        @livewireScripts
    </body>
    <script>
        function dropdownHandler(element) {
            let single = element.getElementsByTagName("ul")[0];
            single.classList.toggle("hidden");
        }
        function MenuHandler(el, val) {
            let MainList = el.parentElement.parentElement.getElementsByTagName("ul")[0];
            let closeIcon = el.parentElement.parentElement.getElementsByClassName("close-m-menu")[0];
            let showIcon = el.parentElement.parentElement.getElementsByClassName("show-m-menu")[0];
            if (val) {
                MainList.classList.remove("hidden");
                el.classList.add("hidden");
                closeIcon.classList.remove("hidden");
            } else {
                showIcon.classList.remove("hidden");
                MainList.classList.add("hidden");
                el.classList.add("hidden");
            }
        }
        // ------------------------------------------------------
        let sideBar = document.getElementById("mobile-nav");
        let menu = document.getElementById("menu");
        let cross = document.getElementById("cross");
        const sidebarHandler = (check) => {
            if (check) {
                sideBar.style.transform = "translateX(0px)";
                menu.classList.add("hidden");
                cross.classList.remove("hidden");
            } else {
                sideBar.style.transform = "translateX(-100%)";
                menu.classList.remove("hidden");
                cross.classList.add("hidden");
            }
        };
        let list = document.getElementById("list");
        let chevrondown = document.getElementById("chevrondown");
        let chevronup = document.getElementById("chevronup");
        const listHandler = (check) => {
            if (check) {
                list.classList.remove("hidden");
                chevrondown.classList.remove("hidden");
                chevronup.classList.add("hidden");
            } else {
                list.classList.add("hidden");
                chevrondown.classList.add("hidden");
                chevronup.classList.remove("hidden");
            }
        };
    </script>
</html>
