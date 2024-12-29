<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <!-- ...existing code... -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- ...existing code... -->
</head>

<body>
    <nav x-data="{ open: false }" class="bg-gradient-to-r from-blue-600 to-blue-800 shadow-lg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20">
                <div class="flex">
                    <!-- Logo -->
                    <div class="shrink-0 flex items-center">
                        <a href="{{ route('dashboard') }}" class="flex items-center">
                            <svg class="w-10 h-10 text-white mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"></path>
                            </svg>
                            <span class="text-white font-bold text-2xl">ABC Cars</span>
                        </a>
                    </div>

                    <!-- Navigation Links -->
                    <div class="hidden sm:ml-10 sm:flex sm:space-x-6 sm:items-center">
                        <a href="{{ route('cars.index') }}" class="text-white hover:bg-green-500 hover:text-white px-3 py-2 rounded-md text-sm font-medium transition duration-300 ease-in-out transform hover:-translate-y-1">
                            {{ __('Car Listings') }}
                        </a>

                        <a href="{{ route('about') }}" class="text-white hover:bg-green-500 hover:text-white px-3 py-2 rounded-md text-sm font-medium transition duration-300 ease-in-out transform hover:-translate-y-1">
                            {{ __('About Us') }}
                        </a>

                        <a href="{{ route('contact') }}" class="text-white hover:bg-green-500 hover:text-white px-3 py-2 rounded-md text-sm font-medium transition duration-300 ease-in-out transform hover:-translate-y-1">
                            {{ __('Contact Us') }}
                        </a>
                        @auth
                        @if(Auth::user()->isUser())
                        <a href="{{ route('appointments.index') }}" class="text-white hover:bg-green-500 hover:text-white px-3 py-2 rounded-md text-sm font-medium transition duration-300 ease-in-out transform hover:-translate-y-1">Book Appointments</a>
                        @endif
                        @endauth
                        @auth
                        @if(Auth::user()->isAdmin())
                        <li>
                            <a href="{{ route('admin.dashboard') }}" class="text-gray-700 hover:text-blue-500">
                                <!-- You can use an icon here if desired -->
                                <span class="text-white hover:bg-green-500 hover:text-white px-3 py-2 rounded-md text-sm font-medium transition duration-300 ease-in-out transform hover:-translate-y-1">Admin Dashboard</span>
                            </a>
                        </li>
                        @endif
                        @endauth
                    </div>
                </div>

                <!-- User Authentication and Settings -->
                <div class="hidden sm:flex sm:items-center sm:ml-6">
                    @auth
                    <div class="relative" x-data="{ dropdownOpen: false }">
                        <button
                            @click="dropdownOpen = !dropdownOpen"
                            class="flex items-center text-white hover:bg-blue-700 px-4 py-2 rounded-full transition duration-300 ease-in-out">
                            <span class="mr-2">{{ Auth::user()->name }}</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>

                        <div
                            x-show="dropdownOpen"
                            @click.away="dropdownOpen = false"
                            class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-xl z-20 overflow-hidden">
                            <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-gray-800 hover:bg-blue-100 transition duration-300">
                                {{ __('Profile') }}
                            </a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <a href="{{ route('logout') }}"
                                    onclick="event.preventDefault(); this.closest('form').submit();"
                                    class="block px-4 py-2 text-gray-800 hover:bg-blue-100 transition duration-300">
                                    {{ __('Log Out') }}
                                </a>
                            </form>
                        </div>
                    </div>
                    @else
                    <div class="flex space-x-4">
                        <a href="{{ route('login') }}" class="text-white hover:bg-blue-700 px-4 py-2 rounded-md transition duration-300">
                            {{ __('Login') }}
                        </a>
                        <a href="{{ route('register') }}" class="bg-white text-blue-600 hover:bg-blue-50 px-4 py-2 rounded-md transition duration-300">
                            {{ __('Register') }}
                        </a>
                    </div>
                    @endauth
                </div>

                <!-- Mobile menu button -->
                <div class="-mr-2 flex items-center sm:hidden">
                    <button
                        @click="open = !open"
                        class="inline-flex items-center justify-center p-2 rounded-md text-white hover:text-blue-200 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-blue-500">
                        <span class="sr-only">Open main menu</span>
                        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile menu -->
        <div
            x-show="open"
            class="sm:hidden bg-blue-700"
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 scale-95"
            x-transition:enter-end="opacity-100 scale-100"
            x-transition:leave="transition ease-in duration-150"
            x-transition:leave-start="opacity-100 scale-100"
            x-transition:leave-end="opacity-0 scale-95">
            <div class="pt-2 pb-3 space-y-1">
                <a href="{{ route('cars.index') }}" class="text-white hover:bg-blue-800 block px-3 py-2 rounded-md text-base font-medium">
                    {{ __('Car Listings') }}
                </a>
                <a href="{{ route('about') }}" class="text-white hover:bg-blue-800 block px-3 py-2 rounded-md text-base font-medium">
                    {{ __('About Us') }}
                </a>
                <a href="{{ route('contact') }}" class="text-white hover:bg-blue-800 block px-3 py-2 rounded-md text-base font-medium">
                    {{ __('Contact Us') }}
                </a>

                @if(Auth::check() && Auth::user()->isAdmin())
                <a href="{{ route('admin.dashboard') }}" class="text-white hover:bg-blue-800 block px-3 py-2 rounded-md text-base font-medium">
                    {{ __('Admin Dashboard') }}
                </a>
                @endif
            </div>

            @auth
            <div class="pt-4 pb-3 border-t border-blue-800">
                <div class="flex items-center px-4">
                    <div>
                        <div class="text-base font-medium text-white">{{ Auth::user()->name }}</div>
                        <div class="text-sm font-medium text-blue-200">{{ Auth::user()->email }}</div>
                    </div>
                </div>
                <div class="mt-3 space-y-1">
                    <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-white hover:bg-blue-800">
                        {{ __('Profile') }}
                    </a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <a href="{{ route('logout') }}"
                            onclick="event.preventDefault(); this.closest('form').submit();"
                            class="block px-4 py-2 text-white hover:bg-blue-800">
                            {{ __('Log Out') }}
                        </a>
                    </form>
                </div>
            </div>
            @else
            <div class="pt-4 pb-3 border-t border-blue-800 space-y-2 px-4">
                <a href="{{ route('login') }}" class="block w-full text-center text-white hover:bg-blue-800 px-4 py-2 rounded-md">
                    {{ __('Login') }}
                </a>
                <a href="{{ route('register') }}" class="block w-full text-center bg-white text-blue-600 hover:bg-blue-50 px-4 py-2 rounded-md">
                    {{ __('Register') }}
                </a>
            </div>
            @endauth
        </div>
    </nav>

</body>

</html>