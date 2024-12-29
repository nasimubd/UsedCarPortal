@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
        {{-- Image Display Section --}}
        <div class="w-full h-96 bg-gray-200">
            @if($car->image_path)
            <img
                src="{{ asset($car->image_path) }}"
                alt="{{ $car->make }} {{ $car->model }}"
                class="w-full h-full object-cover">
            @else
            <div class="flex items-center justify-center h-full text-gray-500">
                No Image Available
            </div>
            @endif
        </div>

        <div class="bg-white shadow-md rounded-lg overflow-hidden">


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

                @auth
                <div class="mt-6 flex space-x-4">
                    <a href="{{ route('appointments.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Book Test Drive
                    </a>

                    <a href="{{ route('bids.create') }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                        Place a Bid
                    </a>
                    <a href="{{ route('cars.edit', $car) }}" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded">
                        Edit Listing
                    </a>
                </div>
                @endauth
            </div>
        </div>

        <div class="mt-6">
            <a href="{{ route('cars.index') }}" class="text-blue-500 hover:underline">← Back to Listings</a>
        </div>
    </div>
</div>
@endsection