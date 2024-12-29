@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white shadow-md rounded-lg p-6">
            <h1 class="text-2xl font-semibold mb-4">Edit Car Listing</h1>

            @if ($errors->any())
            <div class="mb-4 bg-red-50 border border-red-400 text-red-700 p-4 rounded">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <form action="{{ route('cars.update', $car) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="make" class="block text-gray-700 font-medium mb-2">Make</label>
                        <input type="text" name="make" id="make"
                            value="{{ old('make', $car->make) }}"
                            class="w-full border rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    <div>
                        <label for="model" class="block text-gray-700 font-medium mb-2">Model</label>
                        <input type="text" name="model" id="model"
                            value="{{ old('model', $car->model) }}"
                            class="w-full border rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    <div>
                        <label for="registration_year" class="block text-gray-700 font-medium mb-2">Registration Year</label>
                        <input type="number" name="registration_year" id="registration_year"
                            value="{{ old('registration_year', $car->registration_year) }}"
                            class="w-full border rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                            min="1900" max="{{ date('Y') + 1 }}">
                    </div>

                    <div>
                        <label for="price" class="block text-gray-700 font-medium mb-2">Price ($)</label>
                        <input type="number" name="price" id="price"
                            value="{{ old('price', $car->price) }}"
                            class="w-full border rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                            step="0.01" min="0">
                    </div>

                    <div class="md:col-span-2">
                        <label for="registration_number" class="block text-gray-700 font-medium mb-2">Registration Number</label>
                        <input type="text" name="registration_number" id="registration_number"
                            value="{{ old('registration_number', $car->registration_number) }}"
                            class="w-full border rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    <div class="md:col-span-2">
                        <label for="description" class="block text-gray-700 font-medium mb-2">Description</label>
                        <textarea name="description" id="description" rows="4"
                            class="w-full border rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('description', $car->description) }}</textarea>
                    </div>
                </div>

                <div class="mt-6">
                    <h2 class="text-lg font-medium text-gray-700 mb-4">Current Images</h2>
                    <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                        @foreach($car->images as $image)
                        <div class="relative group">
                            <img src="{{ asset('storage/' . $image->image_path) }}"
                                alt="Car image"
                                class="w-full h-48 object-cover rounded-lg {{ $image->is_primary ? 'ring-4 ring-blue-500' : '' }}">
                            <div class="absolute inset-0 bg-black bg-opacity-40 opacity-0 group-hover:opacity-100 transition-opacity rounded-lg flex items-center justify-center">
                                <label class="flex items-center space-x-2 text-white cursor-pointer">
                                    <input type="checkbox" name="remove_images[]" value="{{ $image->id }}"
                                        class="form-checkbox h-5 w-5 text-red-600">
                                    <span>Remove</span>
                                </label>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

                <div class="mt-6">
                    <label for="images" class="block text-gray-700 font-medium mb-2">Add New Images</label>
                    <input type="file" name="images[]" id="images" multiple accept="image/*"
                        class="w-full border rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <p class="text-sm text-gray-500 mt-1">You can select multiple images. Supported formats: JPEG, PNG, JPG, GIF</p>
                </div>

                <div class="mt-6">
                    <label class="inline-flex items-center">
                        <input type="checkbox" name="is_active" value="1"
                            {{ old('is_active', $car->is_active) ? 'checked' : '' }}
                            class="form-checkbox h-5 w-5 text-blue-600">
                        <span class="ml-2 text-gray-700">Keep listing active</span>
                    </label>
                </div>

                <div class="mt-8 flex justify-end space-x-4">
                    <a href="{{ route('cars.show', $car) }}"
                        class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded-lg">
                        Cancel
                    </a>
                    <button type="submit"
                        class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-lg">
                        Update Car
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection