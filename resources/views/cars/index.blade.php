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
        <div class="bg-white shadow-md rounded-lg p-6 mb-6">
            <form action="{{ route('cars.index') }}" method="GET">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label for="make" class="block text-gray-700">Make</label>
                        <input type="text" name="make" id="make" value="{{ request('make') }}"
                            class="w-full border rounded px-3 py-2">
                    </div>
                    <div>
                        <label for="model" class="block text-gray-700">Model</label>
                        <input type="text" name="model" id="model" value="{{ request('model') }}"
                            class="w-full border rounded px-3 py-2">
                    </div>
                    <div>
                        <label for="registration_year" class="block text-gray-700">Year</label>
                        <input type="number" name="registration_year" id="registration_year"
                            value="{{ request('registration_year') }}"
                            class="w-full border rounded px-3 py-2">
                    </div>
                    <div>
                        <label for="price_min" class="block text-gray-700">Min Price</label>
                        <input type="number" name="price_min" id="price_min"
                            value="{{ request('price_min') }}"
                            class="w-full border rounded px-3 py-2">
                    </div>
                    <div>
                        <label for="price_max" class="block text-gray-700">Max Price</label>
                        <input type="number" name="price_max" id="price_max"
                            value="{{ request('price_max') }}"
                            class="w-full border rounded px-3 py-2">
                    </div>
                    <div class="flex items-end">
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Search
                        </button>
                        <a href="{{ route('cars.index') }}" class="ml-2 text-gray-500 hover:underline">
                            Reset
                        </a>
                    </div>
                </div>
            </form>
        </div>
        <!-- [Search form code remains unchanged] -->
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