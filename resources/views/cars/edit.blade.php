@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-50 to-blue-100 py-12">
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white shadow-2xl rounded-2xl overflow-hidden border-t-4 border-blue-500 p-8">
            <div class="flex items-center justify-between mb-8">
                <h1 class="text-3xl font-bold text-gray-800 flex items-center">
                    <svg class="w-8 h-8 mr-3 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                    </svg>
                    Edit Car Listing
                </h1>
            </div>

            @if ($errors->any())
            <div class="mb-6 bg-red-50 border-l-4 border-red-500 p-4 rounded-r-lg">
                <div class="flex items-center">
                    <svg class="w-6 h-6 text-red-500 mr-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <ul class="list-disc list-inside text-red-700">
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
            @endif

            <form action="{{ route('cars.update', $car) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="make" class="block text-sm font-medium text-gray-700 mb-2 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                            </svg>
                            Make
                        </label>
                        <input type="text" name="make" id="make"
                            value="{{ old('make', $car->make) }}"
                            class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 transition">
                    </div>

                    <div>
                        <label for="model" class="block text-sm font-medium text-gray-700 mb-2 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Model
                        </label>
                        <input type="text" name="model" id="model"
                            value="{{ old('model', $car->model) }}"
                            class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 transition">
                    </div>

                    <div>
                        <label for="registration_year" class="block text-sm font-medium text-gray-700 mb-2 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            Registration Year
                        </label>
                        <input type="number" name="registration_year" id="registration_year"
                            value="{{ old('registration_year', $car->registration_year) }}"
                            class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 transition"
                            min="1900" max="{{ date('Y') + 1 }}">
                    </div>

                    <div>
                        <label for="price" class="block text-sm font-medium text-gray-700 mb-2 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Price ($)
                        </label>
                        <input type="number" name="price" id="price"
                            value="{{ old('price', $car->price) }}"
                            class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 transition"
                            step="0.01" min="0">
                    </div>

                    <div class="md:col-span-2">
                        <label for="registration_number" class="block text-sm font-medium text-gray-700 mb-2 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Registration Number
                        </label>
                        <input type="text" name="registration_number" id="registration_number"
                            value="{{ old('registration_number', $car->registration_number) }}"
                            class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 transition">
                    </div>

                    <div class="md:col-span-2">
                        <label for="description" class="block text-sm font-medium text-gray-700 mb-2 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                            </svg>
                            Description
                        </label>
                        <textarea name="description" id="description" rows="4"
                            class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 transition">{{ old('description', $car->description) }}</textarea>
                    </div>
                </div>

                <!-- Image Upload and Management Section -->
                <!-- <div class="mt-6">
                    <h2 class="text-lg font-medium text-gray-700 mb-4">Current Images</h2>
                    <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                        @foreach($car->images as $image)
                        <div class="relative group">
                            <img src="data:{{ $image->mime_type }};base64,{{ base64_encode($image->image_data) }}"
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
                    <label for="images" class="block text-sm font-medium text-gray-700 mb-2">Add New Images</label>
                    <input type="file" name="images[]" id="images" multiple accept="image/*"
                        class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 transition">
                    <p class="text-sm text-gray-500 mt-1">You can select multiple images. Supported formats: JPEG, PNG, JPG, GIF</p>
                </div>

                <div class="mt-6">
                    <label class="inline-flex items-center">
                        <input type="checkbox" name="is_primary_image" value="1"
                            class="form-checkbox h-5 w-5 text-blue-600">
                        <span class="ml-2 text-gray-700">Set first uploaded image as primary</span>
                    </label>
                </div> -->

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
                        class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-3 px-6 rounded-xl transition transform hover:scale-105">
                        Cancel
                    </a>
                    <button type="submit"
                        class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-3 px-6 rounded-xl transition transform hover:scale-105">
                        Update Car
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection