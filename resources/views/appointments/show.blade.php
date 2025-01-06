@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-50 to-blue-100 py-12">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        {{-- Success Message --}}
        @if(session('success'))
        <div class="mb-6 animate-bounce">
            <div class="bg-green-500 text-white px-6 py-4 rounded-xl shadow-lg flex items-center">
                <svg class="w-6 h-6 mr-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <span>{{ session('success') }}</span>
            </div>
        </div>
        @endif

        <div class="bg-white shadow-2xl rounded-2xl overflow-hidden">
            {{-- Header Section --}}
            <div class="bg-blue-600 text-white p-6 flex justify-between items-center">
                <h1 class="text-3xl font-bold">Appointment Details</h1>
                <div class="flex items-center space-x-3">
                    <i class="fas fa-calendar-check text-2xl"></i>
                    @if($appointment->status === 'pending')
                    <span class="bg-yellow-400 text-yellow-900 px-3 py-1 rounded-full text-sm font-semibold">
                        Pending
                    </span>
                    @elseif($appointment->status === 'approved')
                    <span class="bg-green-400 text-green-900 px-3 py-1 rounded-full text-sm font-semibold">
                        Approved
                    </span>
                    @elseif($appointment->status === 'denied')
                    <span class="bg-red-400 text-red-900 px-3 py-1 rounded-full text-sm font-semibold">
                        Denied
                    </span>
                    @endif
                </div>
            </div>

            {{-- Appointment Details Grid --}}
            <div class="grid md:grid-cols-2 gap-8 p-8">
                {{-- Car Information --}}
                <div class="bg-gray-50 rounded-xl p-6 shadow-md">
                    <h2 class="text-xl font-bold mb-4 text-blue-700 border-b pb-2">
                        <i class="fas fa-car mr-2"></i>Car Details
                    </h2>
                    <div class="space-y-3">
                        <div>
                            <p class="text-gray-600 font-semibold">Make & Model:</p>
                            <p class="text-lg font-bold">
                                {{ $appointment->car->make }} {{ $appointment->car->model }}
                            </p>
                        </div>
                        <div>
                            <p class="text-gray-600 font-semibold">Registration Year:</p>
                            <p class="text-lg">{{ $appointment->car->registration_year }}</p>
                        </div>
                    </div>
                </div>

                {{-- Appointment Information --}}
                <div class="bg-gray-50 rounded-xl p-6 shadow-md">
                    <h2 class="text-xl font-bold mb-4 text-blue-700 border-b pb-2">
                        <i class="fas fa-clock mr-2"></i>Appointment Timing
                    </h2>
                    <div class="space-y-3">
                        <div>
                            <p class="text-gray-600 font-semibold">Date & Time:</p>
                            <p class="text-lg font-bold">
                                {{ \Carbon\Carbon::parse($appointment->appointment_datetime)->format('F j, Y, g:i a') }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Action Section --}}
            <div class="bg-gray-100 p-6 flex justify-between items-center">
                <a href="{{ route('appointments.index') }}"
                    class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-3 rounded-lg transition transform hover:scale-105 flex items-center">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Back to Appointments
                </a>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
@endpush