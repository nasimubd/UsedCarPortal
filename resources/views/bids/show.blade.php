@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
        @if(session('success'))
        <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
            {{ session('success') }}
        </div>
        @endif

        <div class="bg-white shadow-md rounded-lg p-6">
            <h1 class="text-2xl font-semibold mb-4">Bid Details</h1>

            <div class="mb-4">
                <h2 class="text-xl font-bold">Car:</h2>
                <p>{{ $bid->car->make }} {{ $bid->car->model }} ({{ $bid->car->registration_year }})</p>
            </div>

            <div class="mb-4">
                <h2 class="text-xl font-bold">Bid Amount:</h2>
                <p>${{ number_format($bid->amount, 2) }}</p>
            </div>

            <div class="mb-4">
                <h2 class="text-xl font-bold">Placed On:</h2>
                <p>{{ $bid->created_at->format('F j, Y, g:i a') }}</p>
            </div>

            <div class="mt-6">
                <a href="{{ route('bids.index') }}" class="text-blue-500 hover:underline">← Back to Bids</a>
            </div>
        </div>
    </div>
</div>
@endsection