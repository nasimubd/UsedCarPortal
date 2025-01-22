@extends('admin.layouts.app')

@section('page-title', 'Bid Management')

@section('content')
<div class="container mx-auto px-4 py-8">
    {{-- Modern Dashboard Header --}}
    <div class="flex flex-col md:flex-row justify-between items-center mb-8 space-y-4 md:space-y-0">
        <div class="flex items-center space-x-4">
            <div class="bg-gradient-to-r from-blue-600 to-purple-600 p-3 rounded-2xl shadow-lg">
                <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path>
                </svg>
            </div>
            <div>
                <h1 class="text-3xl font-extrabold bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">Bid Management</h1>
                <p class="text-gray-500">Monitor and manage all bidding activities</p>
            </div>
        </div>

        {{-- Enhanced Search Bar --}}
        <div class="relative w-full md:w-96">
            <input type="search" placeholder="Search bids..."
                class="w-full pl-12 pr-4 py-3 rounded-xl border-2 border-gray-200 focus:border-blue-500 focus:ring-4 focus:ring-blue-100 transition-all duration-300">
            <svg class="w-6 h-6 text-gray-400 absolute left-3 top-1/2 transform -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
            </svg>
        </div>
    </div>

    @if($bids->count())
    <div class="bg-white shadow-2xl rounded-2xl overflow-hidden border border-gray-100">
        {{-- Desktop View --}}
        <div class="hidden md:block overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="bg-gradient-to-r from-blue-500 to-purple-600">
                        <th class="px-6 py-4 text-left text-white font-semibold">User</th>
                        <th class="px-6 py-4 text-left text-white font-semibold">Car Details</th>
                        <th class="px-6 py-4 text-left text-white font-semibold">Bid Amount</th>
                        <th class="px-6 py-4 text-left text-white font-semibold">Date</th>
                        <th class="px-6 py-4 text-left text-white font-semibold">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($bids as $bid)
                    <tr class="border-b hover:bg-gray-50 transition-all duration-200">
                        <td class="px-6 py-4">
                            <div class="flex items-center space-x-3">
                                <div class="w-10 h-10 rounded-lg bg-gradient-to-br from-blue-500 to-purple-600 text-white flex items-center justify-center font-bold shadow-lg">
                                    {{ strtoupper(substr($bid->user->name, 0, 1)) }}
                                </div>
                                <div>
                                    <div class="font-semibold text-gray-800">{{ $bid->user->name }}</div>
                                    <div class="text-sm text-gray-500">{{ $bid->user->email }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="font-medium text-gray-800">{{ $bid->car->make }} {{ $bid->car->model }}</div>
                            <div class="text-sm text-gray-500">Year: {{ $bid->car->registration_year }}</div>
                        </td>
                        <td class="px-6 py-4">
                            <span class="bg-gradient-to-r from-green-500 to-emerald-500 text-white px-4 py-2 rounded-full text-sm font-bold shadow-lg">
                                ${{ number_format($bid->amount, 2) }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-gray-600">{{ $bid->created_at->format('M d, Y') }}</div>
                            <div class="text-sm text-gray-400">{{ $bid->created_at->format('h:i A') }}</div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex space-x-3">
                                <button class="p-2 rounded-lg bg-blue-100 text-blue-600 hover:bg-blue-200 transition-all duration-200">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                </button>
                                <button class="p-2 rounded-lg bg-red-100 text-red-600 hover:bg-red-200 transition-all duration-200">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- Mobile View --}}
        <div class="md:hidden divide-y divide-gray-200">
            @foreach($bids as $bid)
            <div class="p-4 space-y-3">
                <div class="flex justify-between items-start">
                    <div class="flex items-center space-x-3">
                        <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-blue-500 to-purple-600 text-white flex items-center justify-center font-bold text-lg shadow-lg">
                            {{ strtoupper(substr($bid->user->name, 0, 1)) }}
                        </div>
                        <div>
                            <div class="font-semibold text-gray-800">{{ $bid->user->name }}</div>
                            <div class="text-sm text-gray-500">{{ $bid->car->make }} {{ $bid->car->model }}</div>
                        </div>
                    </div>
                    <span class="bg-gradient-to-r from-green-500 to-emerald-500 text-white px-3 py-1 rounded-full text-sm font-bold shadow-lg">
                        ${{ number_format($bid->amount, 2) }}
                    </span>
                </div>
                <div class="flex justify-between items-center pt-2">
                    <div class="text-sm text-gray-500">{{ $bid->created_at->format('M d, Y h:i A') }}</div>
                    <div class="flex space-x-2">
                        <button class="p-2 rounded-lg bg-blue-100 text-blue-600">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                        </button>
                        <button class="p-2 rounded-lg bg-red-100 text-red-600">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <div class="mt-6">
        {{ $bids->links('vendor.pagination.tailwind') }}
    </div>

    @else
    <div class="bg-white rounded-2xl shadow-2xl p-12 text-center">
        <div class="w-24 h-24 bg-gradient-to-r from-blue-500 to-purple-600 rounded-full mx-auto flex items-center justify-center mb-6">
            <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
        </div>
        <h2 class="text-3xl font-bold bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">No Bids Available</h2>
        <p class="mt-2 text-gray-500 text-lg">Start receiving bids by listing more cars on the platform.</p>
    </div>
    @endif
</div>
@endsection