@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white shadow-md rounded-lg p-6">
            <h1 class="text-2xl font-semibold mb-4">Place a Bid</h1>

            @if ($errors->any())
            <div class="mb-4">
                <ul class="list-disc list-inside text-red-500">
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <form action="{{ route('bids.store') }}" method="POST">
                @csrf

                <div class="mb-4">
                    <label for="car_id" class="block text-gray-700">Select Car:</label>
                    <select name="car_id" id="car_id" required class="w-full border rounded px-3 py-2">
                        <option value="">-- Choose a Car --</option>
                        @foreach($cars as $car)
                        <option value="{{ $car->id }}" {{ old('car_id') == $car->id ? 'selected' : '' }}>
                            {{ $car->make }} {{ $car->model }} ({{ $car->registration_year }})
                        </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-4">
                    <label for="amount" class="block text-gray-700">Bid Amount ($):</label>
                    <input type="number" name="amount" id="amount" value="{{ old('amount') }}" required class="w-full border rounded px-3 py-2" step="0.01" min="0">
                </div>

                <div class="flex justify-end">
                    <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                        Place Bid
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection