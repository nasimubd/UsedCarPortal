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

                <!-- Bid Submission Form -->
                @auth
                @if(auth()->check() && auth()->user()->role === 'user')
                <div class="mt-6 p-6 bg-white rounded-lg shadow-md">
                    <h3 class="text-lg font-semibold mb-4">Place Your Bid</h3>

                    <form action="{{ route('bids.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="car_id" value="{{ $car->id }}">

                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">
                                Your Bid Amount ($)
                            </label>
                            <input type="number"
                                name="bid_amount"
                                step="0.01"
                                min="0"
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                required>
                        </div>

                        <button type="submit"
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                            Place Bid
                        </button>
                    </form>
                </div>
                @endif
                @endauth

                <!-- Display Highest Bid -->
                <div class="mt-4">
                    <h4 class="font-semibold">Current Highest Bid:</h4>
                    @php
                    $highestBid = $car->bids()->latest('bid_amount')->first();
                    @endphp

                    @if($highestBid)
                    <p class="text-xl text-green-600">${{ number_format($highestBid->bid_amount, 2) }}</p>
                    <p class="text-sm text-gray-600">Bid placed by: {{ $highestBid->user->name }}</p>
                    <p class="text-sm text-gray-600">{{ $highestBid->created_at->diffForHumans() }}</p>
                    @else
                    <p class="text-xl">No bids yet</p>
                    @endif
                </div>

                <!-- Recent Bids -->
                <div class="mt-6">
                    <h4 class="font-semibold mb-2">Recent Bids</h4>
                    @foreach($car->bids()->latest()->take(5)->get() as $bid)
                    <div class="border-b py-2">
                        <p>${{ number_format($bid->bid_amount, 2) }} by {{ $bid->user->name }}</p>
                        <p class="text-sm text-gray-600">{{ $bid->created_at->diffForHumans() }}</p>
                    </div>
                    @endforeach
                </div>



                <div class="mt-6 flex space-x-4">
                    @if(Auth::id() === $car->user_id || Auth::user()->isAdmin())
                    <a href="{{ route('cars.edit', $car) }}" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded">
                        Edit
                    </a>

                    <form action="{{ route('cars.destroy', $car) }}" method="POST" onsubmit="return confirm('Are you sure you want to deactivate this car listing?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                            Deactivate
                        </button>
                    </form>
                    @endif
                </div>
            </div>
        </div>

        <div class="mt-6">
            <a href="{{ route('cars.index') }}" class="text-blue-500 hover:underline">← Back to Listings</a>
        </div>
    </div>
</div>
@endsection