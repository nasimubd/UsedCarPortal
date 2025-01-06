@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-50 to-blue-100 py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        {{-- Success Message with Modern Animation --}}
        @if(session('success'))
        <div class="mb-6">
            <div class="bg-green-500 text-white px-6 py-4 rounded-xl shadow-lg flex items-center transform transition hover:scale-105">
                <svg class="w-6 h-6 mr-4 animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <span class="font-medium">{{ session('success') }}</span>
            </div>
        </div>
        @endif

        {{-- Header Section --}}
        <div class="flex flex-col md:flex-row justify-between items-center mb-8 space-y-4 md:space-y-0">
            <h1 class="text-3xl font-extrabold text-gray-800 tracking-tight">
                My Vehicle Appointments
            </h1>
            <a href="{{ route('appointments.create') }}"
                class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded-full transition duration-300 ease-in-out transform hover:-translate-y-1 hover:scale-110 flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                Book New Appointment
            </a>
        </div>

        {{-- Appointments List --}}
        @if($appointments->count())
        <div class="grid gap-6">
            @foreach($appointments as $appointment)
            <div class="bg-white rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2 p-6">
                <div class="grid md:grid-cols-4 gap-4 items-center">
                    {{-- Car Details --}}
                    <div class="flex items-center space-x-4">
                        <svg class="w-10 h-10 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 14v3m4-3v3m4-3v3M3 21h18M3 10h18M3 7l9-4 9 4M4 10h16v11H4V10z"></path>
                        </svg>
                        <div>
                            <p class="font-bold text-gray-800">{{ $appointment->car->make }} {{ $appointment->car->model }}</p>
                        </div>
                    </div>

                    {{-- Appointment Date --}}
                    <div class="flex items-center space-x-2">
                        <svg class="w-6 h-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        <span class="text-gray-600">
                            {{ \Carbon\Carbon::parse($appointment->appointment_datetime)->format('F j, Y, g:i a') }}
                        </span>
                    </div>

                    {{-- Status --}}
                    <div>
                        @php
                        $statusClasses = [
                        'pending' => 'bg-yellow-100 text-yellow-800',
                        'approved' => 'bg-green-100 text-green-800',
                        'denied' => 'bg-red-100 text-red-800'
                        ];
                        @endphp
                        <span class="px-3 py-1 text-xs font-semibold rounded-full {{ $statusClasses[$appointment->status] }}">
                            {{ ucfirst($appointment->status) }}
                        </span>
                    </div>

                    {{-- Actions --}}
                    <div class="text-right">
                        <a href="{{ route('appointments.show', $appointment) }}"
                            class="text-blue-600 hover:text-blue-800 font-semibold flex items-center justify-end space-x-2">
                            <span>View Details</span>
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5l7 7-7 7M5 5l7 7-7 7"></path>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        {{-- Pagination --}}
        <div class="mt-8 flex justify-center">
            {{ $appointments->links('vendor.pagination.tailwind') }}
        </div>
        @else
        {{-- Empty State --}}
        <div class="text-center bg-white rounded-xl shadow-lg p-12">
            <svg class="mx-auto w-24 h-24 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
            </svg>
            <h2 class="text-2xl font-bold text-gray-600 mb-4">No Appointments Yet</h2>
            <p class="text-gray-500 mb-6">You haven't booked any appointments. Start exploring and book your first appointment!</p>
            <a href="{{ route('appointments.create') }}" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-3 px-6 rounded-full">
                Book an Appointment
            </a>
        </div>
        @endif
    </div>
</div>
@endsection