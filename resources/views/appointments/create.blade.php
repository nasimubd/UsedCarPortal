@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white shadow-md rounded-lg p-6">
            <h1 class="text-2xl font-semibold mb-4">Book a Test Drive Appointment</h1>

            @if ($errors->any())
            <div class="mb-4">
                <ul class="list-disc list-inside text-red-500">
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <form action="{{ route('appointments.store') }}" method="POST">
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
                    <label for="appointment_datetime" class="block text-gray-700">Appointment Date & Time:</label>
                    <input type="datetime-local" name="appointment_datetime" id="appointment_datetime" value="{{ old('appointment_datetime') }}" required class="w-full border rounded px-3 py-2">
                </div>

                <div class="flex justify-end">
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Book Appointment
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection