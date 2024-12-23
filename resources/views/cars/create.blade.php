@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white shadow-md rounded-lg p-6">
            <h1 class="text-2xl font-semibold mb-4">Post a Car for Sale</h1>

            @if ($errors->any())
            <div class="mb-4">
                <ul class="list-disc list-inside text-red-500">
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <form action="{{ route('cars.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-4">
                    <label for="make" class="block text-gray-700">Make:</label>
                    <input type="text" name="make" id="make" value="{{ old('make') }}" required class="w-full border rounded px-3 py-2">
                </div>

                <div class="mb-4">
                    <label for="model" class="block text-gray-700">Model:</label>
                    <input type="text" name="model" id="model" value="{{ old('model') }}" required class="w-full border rounded px-3 py-2">
                </div>

                <div class="mb-4">
                    <label for="registration_year" class="block text-gray-700">Registration Year:</label>
                    <input type="number" name="registration_year" id="registration_year" value="{{ old('registration_year') }}" required class="w-full border rounded px-3 py-2" min="1900" max="{{ date('Y') + 1 }}">
                </div>

                <div class="mb-4">
                    <label for="price" class="block text-gray-700">Price ($):</label>
                    <input type="number" name="price" id="price" value="{{ old('price') }}" required class="w-full border rounded px-3 py-2" step="0.01" min="0">
                </div>

                <div class="mb-4">
                    <label for="registration_number" class="block text-gray-700">Registration Number:</label>
                    <input type="text" name="registration_number" id="registration_number" value="{{ old('registration_number') }}" required class="w-full border rounded px-3 py-2">
                </div>

                <div class="mb-4">
                    <label for="description" class="block text-gray-700">Description:</label>
                    <textarea name="description" id="description" rows="4" class="w-full border rounded px-3 py-2">{{ old('description') }}</textarea>
                </div>

                <div class="mb-4">
                    <label for="image" class="block text-gray-700">Car Image:</label>
                    <input type="file" name="image" id="image" accept="image/*" class="w-full">
                </div>

                <div class="flex justify-end">
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Post Car
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection