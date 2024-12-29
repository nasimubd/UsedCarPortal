@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        @if(session('success'))
        <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
            {{ session('success') }}
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
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-semibold">Car Listings</h1>
            <a href="{{ route('cars.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Post a Car for Sale
            </a>
        </div>
        @endauth
        @if($cars->count())
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($cars as $car)
            <div class="bg-white shadow-md rounded-lg overflow-hidden">
                {{-- Car Image --}}
                <div class="h-48 w-full">
                    @if($car->image_path)
                    <img
                        src="{{ asset($car->image_path) }}"
                        alt="{{ $car->make }} {{ $car->model }}"
                        class="w-full h-full object-cover">
                    @else
                    <div class="flex items-center justify-center h-full bg-gray-200 text-gray-500">
                        No Image Available
                    </div>
                    @endif
                </div>
                <div class="p-4">
                    <h2 class="text-xl font-bold">{{ $car->make }} {{ $car->model }}</h2>
                    <p class="text-gray-600">Registration Year: {{ $car->registration_year }}</p>
                    <p class="text-gray-600">Price: ${{ number_format($car->price, 2) }}</p>
                    @if($car->highestBid)
                    <p class="text-gray-600">Highest Bid: ${{ number_format($car->highestBid->amount, 2) }}</p>
                    @else
                    <p class="text-gray-600">No bids yet.</p>
                    @endif
                    <a href="{{ route('cars.show', $car) }}" class="mt-2 inline-block text-blue-500 hover:underline">View Details</a>
                </div>
            </div>
            @endforeach
        </div>

        <div class="mt-6">
            {{ $cars->links() }}
        </div>
        @else
        <p class="text-center text-gray-600">No car listings available matching your criteria.</p>
        @endif
    </div>
</div>
@endsection