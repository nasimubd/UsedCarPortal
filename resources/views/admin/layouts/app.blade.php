<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <title>Admin Dashboard - ABC Cars Portal</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <!-- Add any additional CSS or JS here -->
</head>

<body class="bg-gray-100">
    <div class="flex">
        <!-- Sidebar -->
        <aside class="w-64 bg-white shadow-md min-h-screen">
            <div class="p-6">
                <h1 class="text-2xl font-bold mb-6">Admin Dashboard</h1>
                <nav>
                    <ul>
                        <li class="mb-4">
                            <a href="{{ route('admin.dashboard') }}" class="text-gray-700 hover:text-blue-500">
                                Dashboard
                            </a>
                        </li>
                        <li class="mb-4">
                            <a href="{{ route('admin.users.index') }}" class="text-gray-700 hover:text-blue-500">
                                Users
                            </a>
                        </li>
                        <li class="mb-4">
                            <a href="{{ route('admin.cars.index') }}" class="text-gray-700 hover:text-blue-500">
                                Car Listings
                            </a>
                        </li>
                        <li class="mb-4">
                            <a href="{{ route('admin.appointments.index') }}" class="text-gray-700 hover:text-blue-500">
                                Appointments
                            </a>
                        </li>
                        <li class="mb-4">
                            <a href="{{ route('admin.transactions.index') }}" class="text-gray-700 hover:text-blue-500">
                                Transactions
                            </a>
                        </li>
                        <li class="mb-4">
                            <a href="{{ route('profile.edit') }}" class="text-gray-700 hover:text-blue-500">
                                Profile
                            </a>
                        </li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="text-gray-700 hover:text-blue-500">
                                    Logout
                                </button>
                            </form>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 p-6">
            @yield('content')
        </main>
    </div>
</body>

</html>