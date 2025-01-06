@extends('admin.layouts.app')

@section('page-title', 'Bid Management')

@section('content')
<div class="container mx-auto px-4 py-8">
    {{-- Responsive Page Header --}}
    <div class="flex flex-col md:flex-row justify-between items-center mb-8 space-y-4 md:space-y-0">
        <h1 class="text-3xl font-extrabold text-gray-800 flex items-center">
            <svg class="w-10 h-10 mr-4 text-blue-600 animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path>
            </svg>
            Bid Management
        </h1>

        {{-- Responsive Search and Filter --}}
        <div class="w-full md:w-auto flex space-x-2">
            <input
                type="search"
                placeholder="Search bids..."
                class="flex-grow px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 transition">
            <button class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition">
                <i class="fas fa-search"></i>
            </button>
        </div>
    </div>

    {{-- Responsive Bids Table --}}
    @if($bids->count())
    <div class="bg-white shadow-2xl rounded-xl overflow-hidden">
        {{-- Desktop Table --}}
        <div class="hidden md:block overflow-x-auto">
            <table class="min-w-full">
                <thead class="bg-gradient-to-r from-blue-500 to-purple-600 text-white">
                    <tr>
                        <th class="px-6 py-4 text-left">User</th>
                        <th class="px-6 py-4 text-left">Car</th>
                        <th class="px-6 py-4 text-left">Bid Amount</th>
                        <th class="px-6 py-4 text-left">Date</th>
                        <th class="px-6 py-4 text-left">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($bids as $bid)
                    <tr class="border-b hover:bg-gray-50 transition">
                        <td class="px-6 py-4">
                            <div class="flex items-center">
                                <div class="w-10 h-10 rounded-full bg-blue-500 text-white flex items-center justify-center mr-3">
                                    {{ strtoupper(substr($bid->user->name, 0, 1)) }}
                                </div>
                                <div>
                                    <div class="font-semibold">{{ $bid->user->name }}</div>
                                    <div class="text-sm text-gray-500">{{ $bid->user->email }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="font-medium">{{ $bid->car->make }} {{ $bid->car->model }}</div>
                            <div class="text-sm text-gray-500">{{ $bid->car->registration_year }}</div>
                        </td>
                        <td class="px-6 py-4">
                            <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm font-bold">
                                ${{ number_format($bid->amount, 2) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-600">
                            {{ $bid->created_at->format('M d, Y') }}
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex space-x-2">
                                <a href="#" class="text-blue-500 hover:text-blue-700">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="#" class="text-red-500 hover:text-red-700">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- Mobile Card View --}}
        <div class="md:hidden">
            @foreach($bids as $bid)
            <div class="p-4 border-b hover:bg-gray-50 transition">
                <div class="flex justify-between items-center mb-2">
                    <div class="flex items-center">
                        <div class="w-8 h-8 rounded-full bg-blue-500 text-white flex items-center justify-center mr-2">
                            {{ strtoupper(substr($bid->user->name, 0, 1)) }}
                        </div>
                        <span class="font-semibold">{{ $bid->user->name }}</span>
                    </div>
                    <span class="bg-green-100 text-green-800 px-2 py-1 rounded-full text-xs">
                        ${{ number_format($bid->amount, 2) }}
                    </span>
                </div>
                <div class="text-sm text-gray-600 mb-2">
                    {{ $bid->car->make }} {{ $bid->car->model }} ({{ $bid->car->registration_year }})
                </div>
                <div class="flex justify-between items-center text-xs text-gray-500">
                    <span>{{ $bid->created_at->format('M d, Y') }}</span>
                    <div class="space-x-2">
                        <a href="#" class="text-blue-500"><i class="fas fa-eye"></i></a>
                        <a href="#" class="text-red-500"><i class="fas fa-trash"></i></a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    {{-- Pagination --}}
    <div class="mt-6">
        {{ $bids->links('vendor.pagination.tailwind') }}
    </div>
    @else
    {{-- Empty State --}}
    <div class="bg-white rounded-xl shadow-2xl p-12 text-center">
        <svg class="mx-auto h-32 w-32 text-gray-300 animate-bounce" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
        </svg>
        <h2 class="mt-6 text-3xl font-bold text-gray-600">No Bids Yet</h2>
        <p class="mt-2 text-gray-500 text-lg">There are currently no bids in the system.</p>
    </div>
    @endif
</div>
@endsection