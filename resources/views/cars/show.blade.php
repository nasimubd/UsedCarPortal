@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
        @if(session('success'))
        <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
            {{ session('success') }}
        </div>
        @endif

        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            @if($car->image_path)
            <img src="{{ asset('storage/' . $car->image_path) }}" alt="{{ $car->make }} {{ $car->model }}" class="w-full h-64 object-cover">
            @else
            <img src="{{ asset('images/no-image.png') }}" alt="No Image" class="w-full h-64 object-cover">
            @endif

            <div class="p-6">
                <h1 class="text-3xl font-bold">{{ $car->make }} {{ $car->model }}</h1>
                <p class="text-gray-600">Registration Year: {{ $car->registration_year }}</p>
                <p class="text-gray-600">Price: ${{ number_format($car->price, 2) }}</p>
                <p class="text-gray-600">Registration Number: {{ $car->registration_number }}</p>
                @if($car->description)
                <div class="mt-4">
                    <h2 class="text-xl font-semibold">Description:</h2>
                    <p class="text-gray-700">{{ $car->description }}</p>
                </div>
                @endif

                @if($highestBid)
                <div class="mt-4">
                    <h2 class="text-xl font-semibold">Current Highest Bid:</h2>
                    <p class="text-gray-700">${{ number_format($highestBid->amount, 2) }}</p>
                </div>
                @else
                <div class="mt-4">
                    <p class="text-gray-700">No bids yet for this car.</p>
                </div>
                @endif

                <div class="mt-6 flex space-x-4">
                    <a href="{{ route('appointments.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Book Test Drive
                    </a>

                    <a href="{{ route('bids.create') }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                        Place a Bid
                    </a>
                </div>
            </div>
        </div>

        <div class="mt-6">
            <a href="{{ route('cars.index') }}" class="text-blue-500 hover:underline">← Back to Listings</a>
        </div>
    </div>
</div>
@endsection