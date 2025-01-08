@extends('admin.layouts.app')

<!-- Or if using Vite -->
@vite(['resources/css/app.css', 'resources/js/app.js'])

@section('content')
<div class="container mx-auto px-4 py-8">

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Total Users -->
        <div class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-blue-500 transform transition hover:scale-105">
            <div class="flex justify-between items-center">
                <div>
                    <h2 class="text-lg font-semibold text-gray-600 mb-2">Total Users</h2>
                    <p class="text-3xl font-bold text-blue-600">{{ $totalUsers }}</p>
                </div>
                <i class="fas fa-users text-blue-500 text-4xl opacity-50"></i>
            </div>
        </div>

        <!-- Active Cars -->
        <div class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-green-500 transform transition hover:scale-105">
            <div class="flex justify-between items-center">
                <div>
                    <h2 class="text-lg font-semibold text-gray-600 mb-2">Active Listings</h2>
                    <p class="text-3xl font-bold text-green-600">{{ $activeCars }}</p>
                </div>
                <i class="fas fa-car text-green-500 text-4xl opacity-50"></i>
            </div>
        </div>

        <!-- Pending Appointments -->
        <div class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-yellow-500 transform transition hover:scale-105">
            <div class="flex justify-between items-center">
                <div>
                    <h2 class="text-lg font-semibold text-gray-600 mb-2">Pending Appointments</h2>
                    <p class="text-3xl font-bold text-yellow-600">{{ $pendingAppointments }}</p>
                </div>
                <i class="fas fa-calendar-check text-yellow-500 text-4xl opacity-50"></i>
            </div>
        </div>

        <!-- Total Transactions -->
        <div class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-purple-500 transform transition hover:scale-105">
            <div class="flex justify-between items-center">
                <div>
                    <h2 class="text-lg font-semibold text-gray-600 mb-2">Total Transactions</h2>
                    <p class="text-3xl font-bold text-purple-600">${{ number_format($totalTransactions, 2) }}</p>
                </div>
                <i class="fas fa-money-bill-wave text-purple-500 text-4xl opacity-50"></i>
            </div>
        </div>
    </div>

    <div class="mt-10 grid grid-cols-1 md:grid-cols-2 gap-8">
        <!-- Quick Actions -->
        <div class="bg-white rounded-xl shadow-lg p-6">
            <h2 class="text-2xl font-bold mb-6 text-gray-800">Quick Actions</h2>
            <div class="space-y-4">
                <a href="{{ route('admin.users.index') }}" class="flex items-center text-blue-600 hover:bg-blue-50 p-3 rounded-lg transition">
                    <i class="fas fa-users mr-4"></i>
                    Manage Users
                </a>
                <a href="{{ route('admin.cars.index') }}" class="flex items-center text-green-600 hover:bg-green-50 p-3 rounded-lg transition">
                    <i class="fas fa-car mr-4"></i>
                    Manage Listings
                </a>
                <a href="{{ route('admin.invoices.index') }}" class="flex items-center text-purple-600 hover:bg-purple-50 p-3 rounded-lg transition">
                    <i class="fas fa-file-invoice-dollar mr-4"></i>
                    View Invoices
                </a>

                <a href="{{ route('admin.appointments.index') }}" class="flex items-center text-yellow-600 hover:bg-yellow-50 p-3 rounded-lg transition">
                    <i class="fas fa-calendar-check mr-4"></i>
                    Manage Appointments
                </a>
            </div>
        </div>

        <!-- Recent Activity -->
        <div class="bg-white rounded-xl shadow-lg p-6">
            <h2 class="text-2xl font-bold mb-6 text-gray-800">Recent Activity</h2>
            <!-- Add a component or partial to show recent system activities -->
            <div class="space-y-4">
                <!-- Example activity items -->
                <div class="bg-gray-50 p-4 rounded-lg">
                    <p class="text-sm text-gray-600">New car listing added by John Doe</p>
                    <span class="text-xs text-gray-400">2 hours ago</span>
                </div>
                <div class="bg-gray-50 p-4 rounded-lg">
                    <p class="text-sm text-gray-600">Appointment scheduled for Tesla Model 3</p>
                    <span class="text-xs text-gray-400">4 hours ago</span>
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
@endpush
@endsection