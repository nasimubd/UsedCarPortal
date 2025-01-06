@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-50 to-blue-100 py-12">
    <div class="max-w-xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white shadow-2xl rounded-2xl overflow-hidden">
            {{-- Gradient Header --}}
            <div class="bg-gradient-to-r from-blue-500 to-blue-700 p-6">
                <h1 class="text-3xl font-bold text-white flex items-center">
                    <svg class="w-10 h-10 mr-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    Book a Test Drive
                </h1>
            </div>

            {{-- Form Container --}}
            <form action="{{ route('appointments.store') }}" method="POST" class="p-8 space-y-6">
                @csrf

                {{-- Error Handling --}}
                @if ($errors->any())
                <div class="bg-red-50 border-l-4 border-red-500 p-4 mb-6 animate-pulse">
                    <ul class="list-disc list-inside text-red-600">
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                {{-- Car Selection --}}
                <div class="mb-6">
                    <label for="car_id" class="block text-gray-700 font-medium mb-3 flex items-center">
                        <svg class="w-6 h-6 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"></path>
                        </svg>
                        Select Car for Test Drive
                    </label>
                    <div class="relative">
                        <select
                            name="car_id"
                            id="car_id"
                            required
                            class="w-full px-4 py-3 border-2 border-blue-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition appearance-none">
                            <option value="" class="text-gray-400">-- Choose a Car --</option>
                            @foreach($cars as $car)
                            <option
                                value="{{ $car->id }}"
                                {{ old('car_id') == $car->id ? 'selected' : '' }}
                                class="text-gray-700">
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

                {{-- Date and Time Selection --}}
                <div class="mb-6">
                    <label for="appointment_datetime" class="block text-gray-700 font-medium mb-3 flex items-center">
                        <svg class="w-6 h-6 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        Choose Appointment Date & Time
                    </label>
                    <input
                        type="datetime-local"
                        name="appointment_datetime"
                        id="appointment_datetime"
                        value="{{ old('appointment_datetime') }}"
                        required
                        class="w-full px-4 py-3 border-2 border-blue-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition">
                </div>

                {{-- Submit Button --}}
                <div class="pt-4">
                    <button
                        type="submit"
                        class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-4 rounded-lg transition transform hover:scale-105 shadow-lg flex items-center justify-center">
                        <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path>
                        </svg>
                        Book Appointment
                    </button>
                </div>
            </form>
        </div>

        {{-- Helpful Information Section --}}
        <div class="mt-8 bg-white shadow-xl rounded-2xl p-6 text-center">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">Test Drive Information</h2>
            <p class="text-gray-600">
                Schedule a test drive to experience the car firsthand. Our team will confirm your appointment and provide all necessary details.
            </p>
        </div>
    </div>
</div>
@endsection