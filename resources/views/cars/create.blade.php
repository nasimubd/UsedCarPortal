@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-50 to-blue-100 py-12">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white shadow-2xl rounded-2xl overflow-hidden">
            <div class="bg-gradient-to-r from-blue-500 to-blue-700 p-6">
                <h1 class="text-3xl font-bold text-white">List Your Car</h1>
            </div>

            <form action="{{ route('cars.store') }}" method="POST" enctype="multipart/form-data" class="p-8 space-y-6">
                @csrf

                {{-- Error Handling --}}
                @if ($errors->any())
                <div class="bg-red-50 border-l-4 border-red-500 p-4 mb-6">
                    <div class="flex items-center">
                        <div class="ml-4">
                            <ul class="list-disc list-inside text-red-600">
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                @endif

                {{-- Car Details Grid --}}
                <div class="grid md:grid-cols-2 gap-6">
                    {{-- Make --}}
                    <div>
                        <label class="block text-gray-700 font-medium mb-2">Make</label>
                        <input type="text" name="make"
                            class="w-full px-4 py-3 border-2 border-blue-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition"
                            value="{{ old('make') }}" required>
                    </div>

                    {{-- Model --}}
                    <div>
                        <label class="block text-gray-700 font-medium mb-2">Model</label>
                        <input type="text" name="model"
                            class="w-full px-4 py-3 border-2 border-blue-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition"
                            value="{{ old('model') }}" required>
                    </div>

                    {{-- Registration Year --}}
                    <div>
                        <label class="block text-gray-700 font-medium mb-2">Registration Year</label>
                        <input type="number" name="registration_year"
                            class="w-full px-4 py-3 border-2 border-blue-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition"
                            value="{{ old('registration_year') }}"
                            min="1900" max="{{ date('Y') + 1 }}" required>
                    </div>

                    {{-- Price --}}
                    <div>
                        <label class="block text-gray-700 font-medium mb-2">Price ($)</label>
                        <input type="number" name="price"
                            class="w-full px-4 py-3 border-2 border-blue-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition"
                            value="{{ old('price') }}" step="0.01" min="0" required>
                    </div>

                    {{-- Registration Number --}}
                    <div class="md:col-span-2">
                        <label class="block text-gray-700 font-medium mb-2">Registration Number</label>
                        <input type="text" name="registration_number"
                            class="w-full px-4 py-3 border-2 border-blue-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition"
                            value="{{ old('registration_number') }}" required>
                    </div>

                    {{-- Description --}}
                    <div class="md:col-span-2">
                        <label class="block text-gray-700 font-medium mb-2">Description</label>
                        <textarea name="description" rows="4"
                            class="w-full px-4 py-3 border-2 border-blue-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition">{{ old('description') }}</textarea>
                    </div>

                    {{-- Image Upload --}}
                    <div class="md:col-span-2">
                        <label class="block text-gray-700 font-medium mb-2">Car Image</label>
                        <div class="border-2 border-dashed border-blue-200 rounded-lg p-6 text-center">
                            <input type="file" name="image" {{-- Change from images[] to image --}}
                                class="w-full file:mr-4 file:rounded-full file:border-0 file:bg-blue-50 file:px-4 file:py-2 file:text-blue-700 hover:file:bg-blue-100"
                                accept="image/*">
                            <p class="text-gray-500 mt-2">PNG, JPG, JPEG up to 5MB</p>
                        </div>
                    </div>
                </div>

                {{-- Submit Button --}}
                <div class="mt-8 flex justify-end space-x-4">
                    <a href="{{ route('cars.index') }}"
                        class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded-lg">
                        Cancel
                    </a>

                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-8 rounded-lg transition transform hover:scale-105 shadow-lg">
                        List Car
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection