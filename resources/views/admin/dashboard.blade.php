@extends('admin.layouts.app')

<!-- Or if using Vite -->
@vite(['resources/css/app.css', 'resources/js/app.js'])

@section('content')
<h1 class="text-3xl font-bold mb-6">Admin Dashboard</h1>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    <!-- Total Users -->
    <div class="bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-xl font-semibold mb-2">Total Users</h2>
        <p class="text-3xl">{{ $totalUsers }}</p>
    </div>

    <!-- Active Cars -->
    <div class="bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-xl font-semibold mb-2">Active Car Listings</h2>
        <p class="text-3xl">{{ $activeCars }}</p>
    </div>

    <!-- Pending Appointments -->
    <div class="bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-xl font-semibold mb-2">Pending Appointments</h2>
        <p class="text-3xl">{{ $pendingAppointments }}</p>
    </div>

    <!-- Total Transactions -->
    <div class="bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-xl font-semibold mb-2">Total Transactions</h2>
        <p class="text-3xl">{{ $totalTransactions }}</p>
    </div>
</div>
@endsection