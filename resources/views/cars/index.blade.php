@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-50 to-blue-100 py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        {{-- Success Message --}}
        @if(session('success'))
        <div class="mb-6 animate-bounce">
            <div class="bg-green-500 text-white px-6 py-4 rounded-xl shadow-lg flex items-center">
                <svg class="w-6 h-6 mr-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <span>{{ session('success') }}</span>
            </div>
        </div>
        @endif

        <!-- Search Form -->
        <div class="bg-white shadow-2xl rounded-2xl p-8 mb-10 border-t-4 border-blue-500">
            <form action="{{ route('cars.index') }}" method="GET" class="space-y-6">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    {{-- Make Input with Icon --}}
                    <div class="relative">
                        <label for="make" class="block text-sm font-medium text-gray-700 mb-2 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                            </svg>
                            Make
                        </label>
                        <input type="text" name="make" id="make"
                            value="{{ request('make') }}"
                            placeholder="Enter car make"
                            class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-300 ease-in-out">
                    </div>

                    {{-- Model Input with Icon --}}
                    <div class="relative">
                        <label for="model" class="block text-sm font-medium text-gray-700 mb-2 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Model
                        </label>
                        <input type="text" name="model" id="model"
                            value="{{ request('model') }}"
                            placeholder="Enter car model"
                            class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-300 ease-in-out">
                    </div>

                    {{-- Year Input with Icon --}}
                    <div class="relative">
                        <label for="registration_year" class="block text-sm font-medium text-gray-700 mb-2 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            Year
                        </label>
                        <input type="number" name="registration_year" id="registration_year"
                            value="{{ request('registration_year') }}"
                            placeholder="Car registration year"
                            class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-300 ease-in-out">
                    </div>

                    {{-- Price Range Inputs --}}
                    <div class="relative">
                        <label for="price_min" class="block text-sm font-medium text-gray-700 mb-2 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Min Price
                        </label>
                        <input type="number" name="price_min" id="price_min"
                            value="{{ request('price_min') }}"
                            placeholder="Minimum price"
                            class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-300 ease-in-out">
                    </div>

                    <div class="relative">
                        <label for="price_max" class="block text-sm font-medium text-gray-700 mb-2 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Max Price
                        </label>
                        <input type="number" name="price_max" id="price_max"
                            value="{{ request('price_max') }}"
                            placeholder="Maximum price"
                            class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-300 ease-in-out">
                    </div>

                    {{-- Search and Reset Buttons --}}
                    <div class="flex items-end space-x-4">
                        <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-3 px-6 rounded-xl transition transform hover:scale-105 shadow-lg flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                            Search
                        </button>
                        <button class="bg-green-500 hover:bg-red-600 text-white font-bold py-3 px-6 rounded-xl transition transform hover:scale-105 shadow-lg flex items-center">
                            <a href="{{ route('cars.index') }}" class="text-gray-600 hover:text-white-600 flex items-center transition">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                                </svg>
                                Reset
                            </a>
                        </button>
                    </div>
                </div>
            </form>
        </div>
        <!-- Car Listings -->
        @auth
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-3xl font-bold text-gray-800">Available Cars</h1>
            <a href="{{ route('cars.create') }}" class="bg-green-500 hover:bg-green-600 text-white font-bold py-3 px-6 rounded-lg transition transform hover:scale-105 shadow-lg">
                <i class="fas fa-plus mr-2"></i>List Your Car
            </a>
        </div>
        @endauth

        {{-- Car Grid --}}
        @if($cars->count())
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($cars as $car)
            <div class="bg-white rounded-2xl overflow-hidden shadow-xl transform transition hover:scale-105 hover:shadow-2xl">
                {{-- Car Image --}}
                <div class="h-56 w-full relative">
                    @if($car->image_path)
                    <img src="{{ asset($car->image_path) }}"
                        alt="{{ $car->make }} {{ $car->model }}"
                        class="w-full h-full object-cover">
                    @else
                    <div class="flex items-center justify-center h-full bg-gray-200 text-gray-500">
                        No Image
                    </div>
                    @endif
                    <div class="absolute top-4 right-4 bg-blue-500 text-white px-3 py-1 rounded-full text-sm">
                        {{ $car->registration_year }}
                    </div>
                </div>
                {{-- Car Details --}}
                <div class="p-6">
                    <h2 class="text-2xl font-bold text-gray-800 mb-2">
                        {{ $car->make }} {{ $car->model }}
                    </h2>
                    <div class="flex justify-between items-center mb-4">
                        <span class="text-xl font-semibold text-blue-600">
                            ${{ number_format($car->price, 2) }}
                        </span>
                        @if($car->highestBid)
                        <span class="text-green-600 font-medium">
                            Highest Bid: ${{ number_format($car->highestBid->amount, 2) }}
                        </span>
                        @endif
                    </div>
                    <a href="{{ route('cars.show', $car) }}"
                        class="w-full block text-center bg-blue-500 hover:bg-blue-600 text-white py-3 rounded-lg transition">
                        View Details
                    </a>
                </div>
            </div>
            @endforeach
        </div>

        {{-- Pagination --}}
        <div class="mt-10 flex justify-center">
            {{ $cars->links('vendor.pagination.tailwind') }}
        </div>
        @else
        <div class="text-center bg-white rounded-2xl shadow-xl p-12">
            <svg class="mx-auto h-24 w-24 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <h2 class="mt-6 text-2xl font-semibold text-gray-600">No Cars Found</h2>
            <p class="mt-2 text-gray-500">Try adjusting your search criteria</p>
        </div>
        @endif
    </div>
</div>
@endsection

@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
@endpush