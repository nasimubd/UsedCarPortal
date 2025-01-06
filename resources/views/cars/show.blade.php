@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-50 to-blue-100 py-12">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid md:grid-cols-2 gap-8">
            {{-- Image Section --}}
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
                <div class="h-96 w-full">
                    @if($car->image_path)
                    <img src="{{ asset($car->image_path) }}"
                        alt="{{ $car->make }} {{ $car->model }}"
                        class="w-full h-full object-cover">
                    @else
                    <div class="flex items-center justify-center h-full bg-gray-200 text-gray-500">
                        No Image Available
                    </div>
                    @endif
                </div>
            </div>

            {{-- Car Details Section --}}
            <div class="bg-white rounded-2xl shadow-xl p-8">
                <div class="flex justify-between items-center mb-6">
                    <h1 class="text-3xl font-bold text-gray-800">
                        {{ $car->make }} {{ $car->model }}
                    </h1>
                    <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full">
                        {{ $car->registration_year }}
                    </span>
                </div>

                <div class="space-y-4">
                    <div class="flex justify-between border-b pb-2">
                        <span class="text-gray-600">Price</span>
                        <span class="font-semibold text-blue-600">
                            ${{ number_format($car->price, 2) }}
                        </span>
                    </div>

                    <div class="flex justify-between border-b pb-2">
                        <span class="text-gray-600">Registration Number</span>
                        <span>{{ $car->registration_number }}</span>
                    </div>

                    @if($car->description)
                    <div>
                        <h3 class="text-lg font-semibold mb-2">Description</h3>
                        <p class="text-gray-600">{{ $car->description }}</p>
                    </div>
                    @endif

                    {{-- Highest Bid Section --}}
                    @if($highestBid)
                    <div class="bg-green-50 border-l-4 border-green-500 p-4">
                        <h3 class="font-semibold text-green-800">Current Highest Bid</h3>
                        <p class="text-green-600">${{ number_format($highestBid->amount, 2) }}</p>
                    </div>
                    @endif
                </div>

                {{-- Action Buttons --}}
                @auth
                <div class="mt-8 grid grid-cols-2 gap-4">
                    <a href="{{ route('appointments.create') }}"
                        class="bg-blue-500 hover:bg-blue-600 text-white py-3 rounded-lg text-center transition">
                        Book Test Drive
                    </a>
                    <a href="{{ route('bids.create') }}"
                        class="bg-green-500 hover:bg-green-600 text-white py-3 rounded-lg text-center transition">
                        Place a Bid
                    </a>
                </div>

                {{-- Admin/Owner Actions --}}
                @if(auth()->user()->isAdmin() || auth()->user()->id == $car->user_id)
                <div class="mt-4 flex space-x-4">
                    <a href="{{ route('cars.edit', $car) }}"
                        class="w-full bg-yellow-500 hover:bg-yellow-600 text-white py-3 rounded-lg text-center transition">
                        Edit Listing
                    </a>
                    @if(auth()->user()->isAdmin() || auth()->user()->id == $car->user_id)
                    <form action="{{ route('cars.toggle-status', $car) }}" method="POST" class="w-full">
                        @csrf
                        @method('PATCH')
                        <button type="submit"
                            class="w-full {{ $car->is_active ? 'bg-red-500 hover:bg-red-600' : 'bg-green-500 hover:bg-green-600' }} text-white py-3 rounded-lg transition">
                            {{ $car->is_active ? 'Deactivate' : 'Activate' }} Listing
                        </button>
                    </form>
                    @endif

                </div>
                @endif
                @endauth
            </div>
        </div>
    </div>
</div>
@endsection