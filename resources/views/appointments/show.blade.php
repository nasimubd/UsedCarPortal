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
            <h1 class="text-2xl font-semibold mb-4">Appointment Details</h1>

            <div class="mb-4">
                <h2 class="text-xl font-bold">Car:</h2>
                <p>{{ $appointment->car->make }} {{ $appointment->car->model }} ({{ $appointment->car->registration_year }})</p>
            </div>

            <div class="mb-4">
                <h2 class="text-xl font-bold">Appointment Date & Time:</h2>
                <p>{{ \Carbon\Carbon::parse($appointment->appointment_datetime)->format('F j, Y, g:i a') }}</p>
            </div>

            <div class="mb-4">
                <h2 class="text-xl font-bold">Status:</h2>
                @if($appointment->status === 'pending')
                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                    Pending
                </span>
                @elseif($appointment->status === 'approved')
                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                    Approved
                </span>
                @elseif($appointment->status === 'denied')
                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                    Denied
                </span>
                @endif
            </div>

            <div class="mt-6">
                <a href="{{ route('appointments.index') }}" class="text-blue-500 hover:underline">← Back to Appointments</a>
            </div>
        </div>
    </div>
</div>
@endsection