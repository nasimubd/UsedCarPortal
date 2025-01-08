<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <!-- ...existing code... -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- ...existing code... -->
</head>

<body>
    <nav x-data="{ open: false }" class="bg-white shadow-lg sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20">
                <div class="flex">
                    <!-- Logo with Modern Design -->
                    <div class="shrink-0 flex items-center">
                        <a href="{{ route('dashboard') }}" class="flex items-center group">
                            <svg class="w-10 h-10 text-blue-600 mr-3 group-hover:rotate-6 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"></path>
                            </svg>
                            <span class="text-2xl font-bold text-blue-800 group-hover:text-blue-600 transition-colors">
                                ABC Cars
                            </span>
                        </a>
                    </div>

                    <!-- Modern Navigation Links -->
                    <div class="hidden sm:ml-10 sm:flex sm:space-x-6 sm:items-center">
                        @php
                        $navLinks = [
                        ['route' => 'cars.index', 'label' => 'Car Listings'],
                        ['route' => 'about', 'label' => 'About Us'],
                        ['route' => 'contact', 'label' => 'Contact Us']
                        ];
                        @endphp

                        @foreach($navLinks as $link)
                        <a href="{{ route($link['route']) }}" class="text-gray-700 hover:text-blue-600 px-3 py-2 rounded-md text-sm font-medium transition-all duration-300 ease-in-out hover:bg-blue-50 hover:shadow-sm">
                            {{ __($link['label']) }}
                        </a>
                        @endforeach

                        @auth
                        @if(Auth::user()->isUser())
                        <a href="{{ route('appointments.index') }}" class="text-gray-700 hover:text-blue-600 px-3 py-2 rounded-md text-sm font-medium transition-all duration-300 ease-in-out hover:bg-blue-50 hover:shadow-sm">
                            {{ __('Book Appointments') }}
                        </a>
                        @endif

                        @if(Auth::user()->isAdmin())
                        <a href="{{ route('admin.dashboard') }}" class="text-gray-700 hover:text-blue-600 px-3 py-2 rounded-md text-sm font-medium transition-all duration-300 ease-in-out hover:bg-blue-50 hover:shadow-sm">
                            {{ __('Admin Dashboard') }}
                        </a>
                        @endif
                        @endauth
                    </div>
                </div>

                <!-- User Authentication Section -->
                <div class="hidden sm:flex sm:items-center sm:ml-6">
                    @auth
                    <div class="relative" x-data="{ dropdownOpen: false }">
                        <button
                            @click="dropdownOpen = !dropdownOpen"
                            class="flex items-center bg-blue-50 text-blue-800 px-4 py-2 rounded-full hover:bg-blue-100 transition-all duration-300">
                            <span class="mr-2 font-medium">{{ Auth::user()->name }}</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>

                        <div
                            x-show="dropdownOpen"
                            @click.away="dropdownOpen = false"
                            class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-xl border border-gray-100 z-50">
                            <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-gray-700 hover:bg-blue-50 transition-colors">
                                {{ __('Profile') }}
                            </a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <a href="{{ route('logout') }}"
                                    onclick="event.preventDefault(); this.closest('form').submit();"
                                    class="block px-4 py-2 text-red-600 hover:bg-red-50 transition-colors">
                                    {{ __('Log Out') }}
                                </a>
                            </form>
                        </div>
                    </div>
                    @else
                    <div class="flex space-x-4">
                        <a href="{{ route('login') }}" class="text-blue-600 hover:text-blue-800 px-4 py-2 rounded-md transition-colors">
                            {{ __('Login') }}
                        </a>
                        <a href="{{ route('register') }}" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 transition-colors">
                            {{ __('Register') }}
                        </a>
                    </div>
                    @endauth
                </div>

                <!-- Mobile Menu Button -->
                <div class="-mr-2 flex items-center sm:hidden">
                    <button
                        @click="open = !open"
                        class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-blue-500">
                        <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                            <path :class="{'hidden': open, 'inline-flex': !open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            <path :class="{'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
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