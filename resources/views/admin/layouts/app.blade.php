<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Dashboard - ABC Cars Portal</title>

    <!-- Tailwind CSS and Alpine.js -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body class="bg-gray-100 antialiased">
    <div
        x-data="{ open: false }"
        class="flex flex-col md:flex-row min-h-screen">
        <!-- Mobile Top Navigation -->
        <nav class="md:hidden bg-white shadow-lg sticky top-0 z-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex items-center">
                        <button
                            @click="open = !open"
                            class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-blue-500">
                            <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                <path
                                    :class="{'hidden': open, 'inline-flex': !open }"
                                    class="inline-flex"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M4 6h16M4 12h16M4 18h16" />
                                <path
                                    :class="{'hidden': !open, 'inline-flex': open }"
                                    class="hidden"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>

                        <a href="{{ route('admin.dashboard') }}" class="flex items-center group md:hidden absolute left-1/2 transform -translate-x-1/2">
                            <svg class="w-10 h-10 text-blue-600 mr-3 group-hover:rotate-6 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"></path>
                            </svg>
                            <span class="text-2xl font-bold text-blue-800 group-hover:text-blue-600 transition-colors">
                                ABC Cars
                            </span>
                        </a>
                    </div>

                    <div class="flex items-center">
                        <div class="w-8 h-8 rounded-full bg-blue-500 flex items-center justify-center text-white text-sm">
                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                        </div>
                    </div>
                </div>
            </div>

            <!-- Mobile Menu -->
            <div
                x-show="open"
                class="md:hidden bg-white"
                x-transition:enter="transition ease-out duration-200"
                x-transition:enter-start="opacity-0 scale-95"
                x-transition:enter-end="opacity-100 scale-100"
                x-transition:leave="transition ease-in duration-150"
                x-transition:leave-start="opacity-100 scale-100"
                x-transition:leave-end="opacity-0 scale-95">
                <div class="pt-2 pb-3 space-y-1">
                    @php
                    $menuItems = [
                    ['route' => 'dashboard', 'icon' => 'home', 'label' => 'Dashboard'],
                    ['route' => 'admin.users.index', 'icon' => 'users', 'label' => 'Users'],
                    ['route' => 'admin.cars.index', 'icon' => 'car', 'label' => 'Car Listings'],
                    ['route' => 'admin.appointments.index', 'icon' => 'calendar-alt', 'label' => 'Appointments'],
                    ['route' => 'admin.transactions.index', 'icon' => 'money-check-alt', 'label' => 'Transactions'],
                    ['route' => 'admin.bids.index', 'icon' => 'gavel', 'label' => 'Bids'],
                    ];
                    @endphp

                    @foreach($menuItems as $item)
                    <a
                        href="{{ route($item['route']) }}"
                        class="text-gray-600 hover:bg-gray-100 block px-3 py-2 rounded-md text-base font-medium">
                        <i class="fas fa-{{ $item['icon'] }} mr-3"></i>
                        {{ $item['label'] }}
                    </a>
                    @endforeach

                    <div class="border-t border-gray-200 pt-4">
                        <a
                            href="{{ route('profile.edit') }}"
                            class="text-gray-600 hover:bg-gray-100 block px-3 py-2 rounded-md text-base font-medium">
                            <i class="fas fa-user-cog mr-3"></i>
                            Profile
                        </a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button
                                type="submit"
                                class="text-gray-600 hover:bg-gray-100 w-full text-left block px-3 py-2 rounded-md text-base font-medium">
                                <i class="fas fa-sign-out-alt mr-3"></i>
                                Logout
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Desktop Sidebar -->
        <aside class="hidden md:block w-64 bg-white shadow-xl border-r border-gray-200 p-4">
            <div class="flex items-center justify-center mb-6">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center group">
                    <svg class="w-10 h-10 text-blue-600 mr-3 group-hover:rotate-6 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"></path>
                    </svg>
                    <span class="text-2xl font-bold text-blue-800 group-hover:text-blue-600 transition-colors">
                        ABC Cars
                    </span>
                </a>
            </div>

            <nav>
                @foreach($menuItems as $item)
                <a
                    href="{{ route($item['route']) }}"
                    class="flex items-center py-3 px-4 rounded {{ request()->routeIs($item['route'].'*') ? 'bg-blue-100 text-blue-700' : 'text-gray-600 hover:bg-blue-50' }}">
                    <i class="fas fa-{{ $item['icon'] }} mr-3"></i>
                    {{ $item['label'] }}
                </a>
                @endforeach

                <div class="mt-8 pt-4 border-t border-gray-200">
                    <a
                        href="{{ route('profile.edit') }}"
                        class="flex items-center py-3 px-4 text-gray-600 hover:bg-blue-50 rounded">
                        <i class="fas fa-user-cog mr-3"></i>
                        Profile
                    </a>
                    <form method="POST" action="{{ route('logout') }}" class="mt-2">
                        @csrf
                        <button
                            type="submit"
                            class="w-full flex items-center py-3 px-4 text-gray-600 hover:bg-blue-50 rounded text-left">
                            <i class="fas fa-sign-out-alt mr-3"></i>
                            Logout
                        </button>
                    </form>
                </div>
            </nav>
        </aside>

        <!-- Main Content Area -->
        <main class="flex-1 bg-gray-50 overflow-y-auto">
            <!-- Desktop Top Navigation -->
            <header class="hidden md:flex bg-white shadow-md py-4 px-6 justify-between items-center">
                <h1 class="text-xl font-semibold text-gray-800">@yield('page-title', 'Dashboard')</h1>

                <div class="flex items-center">
                    <span class="mr-3 text-gray-700">{{ Auth::user()->name }}</span>
                    <div class="w-10 h-10 rounded-full bg-blue-500 flex items-center justify-center text-white font-bold">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    </div>
                </div>
            </header>

            <!-- Content Section -->
            <div class="p-4 md:p-6">
                @yield('content')
            </div>
        </main>
    </div>
</body>

</html>