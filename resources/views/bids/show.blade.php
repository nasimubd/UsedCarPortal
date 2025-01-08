@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-4xl mx-auto">
        {{-- Success Message --}}
        @if(session('success'))
        <div class="mb-6 bg-green-50 border-l-4 border-green-500 p-4 animate-fade-in-down">
            <div class="flex items-center">
                <svg class="h-6 w-6 text-green-500 mr-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <p class="text-green-700">{{ session('success') }}</p>
            </div>
        </div>
        @endif

        {{-- Bid Details Card --}}
        <div class="bg-white shadow-2xl rounded-xl overflow-hidden">
            {{-- Header --}}
            <div class="bg-gradient-to-r from-blue-500 to-purple-600 p-6">
                <div class="flex items-center justify-between">
                    <h1 class="text-3xl font-extrabold text-white tracking-wide">
                        Bid Details
                    </h1>
                    <svg class="w-10 h-10 text-white opacity-75" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                </div>
            </div>

            {{-- Content --}}
            <div class="p-8 space-y-6">
                {{-- Car Details Section --}}
                <div class="bg-gray-50 rounded-lg p-6 border border-gray-200">
                    <div class="flex items-center mb-4">
                        <svg class="w-6 h-6 text-blue-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 14v3m4-3v3m4-3v3M3 21h18M3 10h18M3 7l9-4 9 4M4 10h16v11H4V10z"></path>
                        </svg>
                        <h2 class="text-xl font-bold text-gray-800">Car Information</h2>
                    </div>
                    <div class="pl-9 space-y-2">
                        <p class="text-gray-700">
                            <span class="font-semibold">Make & Model:</span>
                            {{ $bid->car->make }} {{ $bid->car->model }}
                        </p>
                        <p class="text-gray-700">
                            <span class="font-semibold">Registration Year:</span>
                            {{ $bid->car->registration_year }}
                        </p>
                    </div>
                </div>

                {{-- Bid Details Section --}}
                <div class="bg-gray-50 rounded-lg p-6 border border-gray-200">
                    <div class="flex items-center mb-4">
                        <svg class="w-6 h-6 text-green-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <h2 class="text-xl font-bold text-gray-800">Bid Information</h2>
                    </div>
                    <div class="pl-9 space-y-2">
                        <p class="text-gray-700">
                            <span class="font-semibold">Bid Amount:</span>
                            <span class="text-green-600 font-bold">
                                ${{ number_format($bid->amount, 2) }}
                            </span>
                        </p>
                        <p class="text-gray-700">
                            <span class="font-semibold">Placed On:</span>
                            {{ $bid->created_at->format('F j, Y, g:i A') }}
                        </p>
                    </div>
                </div>

                {{-- Actions --}}
                <div class="flex justify-between items-center pt-4">
                    <a
                        href="{{ route('bids.index') }}"
                        class="flex items-center text-blue-600 hover:text-blue-800 transition-colors">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        Back to Bids
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection