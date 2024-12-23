@extends('admin.layouts.app')

@section('content')
<h1 class="text-2xl font-semibold mb-6">Manage Car Listings</h1>

<!-- Success and Error Messages -->
@if(session('success'))
<div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
    {{ session('success') }}
</div>
@endif

@if ($errors->any())
<div class="mb-4">
    <ul class="list-disc list-inside text-red-500">
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<!-- Search Form (Optional) -->
<form action="{{ route('admin.cars.index') }}" method="GET" class="mb-6">
    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by make, model, or registration number" class="w-full border rounded px-3 py-2">
</form>

@if($cars->count())
<table class="min-w-full bg-white">
    <thead>
        <tr>
            <th class="py-2 px-4 border-b">Make</th>
            <th class="py-2 px-4 border-b">Model</th>
            <th class="py-2 px-4 border-b">Year</th>
            <th class="py-2 px-4 border-b">Price</th>
            <th class="py-2 px-4 border-b">Registration Number</th>
            <th class="py-2 px-4 border-b">Status</th>
            <th class="py-2 px-4 border-b">Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($cars as $car)
        <tr class="text-center">
            <td class="py-2 px-4 border-b">{{ $car->make }}</td>
            <td class="py-2 px-4 border-b">{{ $car->model }}</td>
            <td class="py-2 px-4 border-b">{{ $car->registration_year }}</td>
            <td class="py-2 px-4 border-b">${{ number_format($car->price, 2) }}</td>
            <td class="py-2 px-4 border-b">{{ $car->registration_number }}</td>
            <td class="py-2 px-4 border-b">
                @if($car->is_active)
                <span class="text-green-500 font-semibold">Active</span>
                @else
                <span class="text-red-500 font-semibold">Inactive</span>
                @endif
            </td>
            <td class="py-2 px-4 border-b">
                @if($car->is_active)
                <form action="{{ route('admin.cars.update', $car) }}" method="POST" class="inline-block">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="is_active" value="0">
                    <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded">
                        Deactivate
                    </button>
                </form>
                @else
                <form action="{{ route('admin.cars.update', $car) }}" method="POST" class="inline-block">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="is_active" value="1">
                    <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-1 px-2 rounded">
                        Activate
                    </button>
                </form>
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<div class="mt-6">
    {{ $cars->links() }}
</div>
@else
<p class="text-center text-gray-600">No car listings found.</p>
@endif
@endsection