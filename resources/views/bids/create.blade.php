@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-3xl mx-auto">
        <div class="bg-white shadow-2xl rounded-xl overflow-hidden">
            <div class="bg-gradient-to-r from-blue-500 to-purple-600 p-6">
                <h1 class="text-3xl font-extrabold text-white text-center tracking-wide">
                    Place Your Bid
                </h1>
            </div>

            <div class="p-8">
                @if ($errors->any())
                <div class="mb-6 bg-red-50 border-l-4 border-red-500 p-4">
                    <div class="flex items-center">
                        <svg class="h-6 w-6 text-red-500 mr-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                        </svg>
                        <ul class="space-y-2">
                            @foreach ($errors->all() as $error)
                            <li class="text-red-700">{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                @endif

                <form action="{{ route('bids.store') }}" method="POST" class="space-y-6">
                    @csrf

                    <div>
                        <label for="car_id" class="block text-sm font-medium text-gray-700 mb-2">
                            Select Car to Bid
                        </label>
                        <div class="relative">
                            <select
                                name="car_id"
                                id="car_id"
                                required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-300 appearance-none">
                                <option value="">-- Choose a Car --</option>
                                @foreach($cars as $car)
                                <option
                                    value="{{ $car->id }}"
                                    {{ old('car_id') == $car->id ? 'selected' : '' }}>
                                    {{ $car->make }} {{ $car->model }} ({{ $car->registration_year }})
                                </option>
                                @endforeach
                            </select>
                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                                </svg>
                            </div>
                        </div>
                    </div>

                    <div>
                        <label for="amount" class="block text-sm font-medium text-gray-700 mb-2">
                            Bid Amount (USD)
                        </label>
                        <div class="relative rounded-md shadow-sm">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <span class="text-gray-500 sm:text-sm">$</span>
                            </div>
                            <input
                                type="number"
                                name="amount"
                                id="amount"
                                value="{{ old('amount') }}"
                                required
                                class="w-full pl-7 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-300"
                                step="0.01"
                                min="0"
                                placeholder="Enter bid amount">
                        </div>
                    </div>

                    <div class="pt-4">
                        <button
                            type="submit"
                            class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition duration-300 ease-in-out transform hover:scale-105">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                            </svg>
                            Place Bid
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection