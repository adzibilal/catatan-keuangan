<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Tailwind CSS via CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <div id="app">
        <nav class="bg-white shadow">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex">
                        <div class="flex-shrink-0 flex items-center">
                            <a class="font-bold text-xl" href="{{ url('/') }}">
                                Catatan Keuangan
                            </a>
                        </div>
                    </div>
                    <div class="flex items-center">
                        <div class="hidden md:ml-6 md:flex md:items-center md:space-x-4">
                            <!-- Authentication Links -->
                            @guest
                                @if (Route::has('login'))
                                    <a class="text-gray-700 hover:text-gray-900 px-3 py-2 rounded-md text-sm font-medium" href="{{ route('login') }}">{{ __('Login') }}</a>
                                @endif

                                @if (Route::has('register'))
                                    <a class="text-gray-700 hover:text-gray-900 px-3 py-2 rounded-md text-sm font-medium" href="{{ route('register') }}">{{ __('Register') }}</a>
                                @endif
                            @else
                                <div class="relative">
                                    <button id="navbarDropdown" class="flex text-sm rounded-full focus:outline-none" type="button">
                                        <span class="px-3 py-2 text-gray-700">{{ Auth::user()->name }}</span>
                                    </button>

                                    <div id="dropdownMenu" class="hidden absolute right-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5">
                                        <a class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" href="{{ route('logout') }}"
                                           onclick="event.preventDefault();
                                                         document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                                            @csrf
                                        </form>
                                    </div>
                                </div>
                            @endguest
                        </div>

                        <!-- Mobile menu button -->
                        <div class="flex items-center md:hidden">
                            <button type="button" id="mobile-menu-button" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500">
                                <span class="sr-only">Open main menu</span>
                                <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </nav>

        <main class="py-4 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            @yield('content')
        </main>
    </div>

    <!-- Simple Dropdown Toggle Script -->
    <script>
        // Dropdown toggle
        document.addEventListener('DOMContentLoaded', function () {
            const dropdown = document.getElementById('navbarDropdown');
            const dropdownMenu = document.getElementById('dropdownMenu');
            
            if (dropdown && dropdownMenu) {
                dropdown.addEventListener('click', function() {
                    dropdownMenu.classList.toggle('hidden');
                });
            }
            
            // Close dropdown when clicking outside
            window.addEventListener('click', function(e) {
                if (dropdown && dropdownMenu && !dropdown.contains(e.target)) {
                    if (!dropdownMenu.classList.contains('hidden')) {
                        dropdownMenu.classList.add('hidden');
                    }
                }
            });
            
            // Mobile menu toggle
            const mobileMenuButton = document.getElementById('mobile-menu-button');
            const mobileMenu = document.getElementById('mobile-menu');
            
            if (mobileMenuButton && mobileMenu) {
                mobileMenuButton.addEventListener('click', function() {
                    mobileMenu.classList.toggle('hidden');
                });
            }
        });
    </script>
</body>
</html>
