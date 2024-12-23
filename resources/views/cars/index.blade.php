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
        <div class="mb-6 bg-white shadow-md rounded-lg p-6">
            <h2 class="text-xl font-semibold mb-4">Search Cars</h2>
            <form action="{{ route('cars.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                <div>
                    <label for="make" class="block text-gray-700">Make:</label>
                    <input type="text" name="make" id="make" value="{{ request('make') }}" class="w-full border rounded px-3 py-2" placeholder="e.g., Toyota">
                </div>

                <div>
                    <label for="model" class="block text-gray-700">Model:</label>
                    <input type="text" name="model" id="model" value="{{ request('model') }}" class="w-full border rounded px-3 py-2" placeholder="e.g., Corolla">
                </div>

                <div>
                    <label for="registration_year" class="block text-gray-700">Registration Year:</label>
                    <input type="number" name="registration_year" id="registration_year" value="{{ request('registration_year') }}" class="w-full border rounded px-3 py-2" placeholder="e.g., 2020" min="1900" max="{{ date('Y') + 1 }}">
                </div>

                <div>
                    <label class="block text-gray-700">Price Range ($):</label>
                    <div class="flex space-x-2">
                        <input type="number" name="price_min" value="{{ request('price_min') }}" class="w-1/2 border rounded px-3 py-2" placeholder="Min" min="0" step="0.01">
                        <input type="number" name="price_max" value="{{ request('price_max') }}" class="w-1/2 border rounded px-3 py-2" placeholder="Max" min="0" step="0.01">
                    </div>
                </div>

                <div class="flex items-end">
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Search
                    </button>
                </div>
            </form>
        </div>

        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-semibold">Car Listings</h1>
            <a href="{{ route('cars.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Post a Car for Sale
            </a>
        </div>

        @if($cars->count())
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($cars as $car)
            <div class="bg-white shadow-md rounded-lg overflow-hidden">
                @if($car->image_path)
                <img src="{{ asset('storage/' . $car->image_path) }}" alt="{{ $car->make }} {{ $car->model }}" class="w-full h-48 object-cover">
                @else
                <img src="{{ asset('images/no-image.png') }}" alt="No Image" class="w-full h-48 object-cover">
                @endif
                <div class="p-4">
                    <h2 class="text-xl font-bold">{{ $car->make }} {{ $car->model }}</h2>
                    <p class="text-gray-600">Registration Year: {{ $car->registration_year }}</p>
                    <p class="text-gray-600">Price: ${{ number_format($car->price, 2) }}</p>
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