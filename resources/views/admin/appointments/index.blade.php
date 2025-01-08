@extends('admin.layouts.app')

@section('page-title', 'Manage Appointments')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="bg-white shadow-2xl rounded-xl overflow-hidden">
        {{-- Responsive Header --}}
        <div class="px-6 py-5 bg-gradient-to-r from-blue-500 to-purple-600 flex flex-col md:flex-row items-center justify-between">
            <div class="flex items-center space-x-4 mb-4 md:mb-0">
                <i class="fas fa-calendar-check text-white text-3xl"></i>
                <h1 class="text-2xl font-bold text-white">Appointment Management</h1>
            </div>

            <div class="flex flex-col md:flex-row items-center space-y-3 md:space-y-0 md:space-x-4 w-full md:w-auto">
                {{-- Search Input --}}
                <div class="relative w-full md:w-64">
                    <input
                        type="text"
                        id="appointment-search"
                        placeholder="Search appointments..."
                        class="w-full pl-10 pr-4 py-2 rounded-lg border-2 border-white/20 bg-white/10 text-white placeholder-white/70 focus:outline-none focus:ring-2 focus:ring-white transition duration-300">
                    <i class="fas fa-search absolute left-3 top-3 text-white/70"></i>
                </div>

                {{-- Filter Dropdown --}}
                <div class="relative w-full md:w-auto">
                    <select
                        id="status-filter"
                        class="w-full md:w-auto px-4 py-2 rounded-lg bg-white/10 border-2 border-white/20 text-white focus:outline-none focus:ring-2 focus:ring-white">
                        <option value="">All Statuses</option>
                        <option value="pending">Pending</option>
                        <option value="approved">Approved</option>
                        <option value="denied">Denied</option>
                    </select>
                </div>
            </div>
        </div>

        {{-- Success/Error Messages --}}
        @if(session('success'))
        <div class="bg-green-50 border-l-4 border-green-500 p-4 m-4">
            <div class="flex items-center">
                <i class="fas fa-check-circle text-green-500 mr-3"></i>
                <p class="text-green-700">{{ session('success') }}</p>
            </div>
        </div>
        @endif

        {{-- Appointments Content --}}
        @if($appointments->count())
        <div class="overflow-x-auto">
            {{-- Desktop Table --}}
            <table class="w-full hidden md:table">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">User</th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">Car Details</th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">Appointment Date</th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-center text-xs font-bold text-gray-600 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach($appointments as $appointment)
                    <tr class="hover:bg-gray-50 transition duration-300">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-10 w-10 mr-4">
                                    <img
                                        class="h-10 w-10 rounded-full object-cover"
                                        src="{{ $appointment->user->avatar ?? 'https://ui-avatars.com/api/?name=' . urlencode($appointment->user->name) }}"
                                        alt="{{ $appointment->user->name }}">
                                </div>
                                <div>
                                    <div class="text-sm font-medium text-gray-900">
                                        {{ $appointment->user->name }}
                                    </div>
                                    <div class="text-sm text-gray-500">
                                        {{ $appointment->user->email }}
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">
                                {{ $appointment->car->make }} {{ $appointment->car->model }}
                            </div>
                            <div class="text-sm text-gray-500">
                                Year: {{ $appointment->car->registration_year }}
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">
                                {{ \Carbon\Carbon::parse($appointment->appointment_datetime)->format('F j, Y') }}
                            </div>
                            <div class="text-sm text-gray-500">
                                {{ \Carbon\Carbon::parse($appointment->appointment_datetime)->format('g:i A') }}
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @switch($appointment->status)
                            @case('pending')
                            <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                <i class="fas fa-clock mr-1"></i>Pending
                            </span>
                            @break
                            @case('approved')
                            <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                <i class="fas fa-check-circle mr-1"></i>Approved
                            </span>
                            @break
                            @case('denied')
                            <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                <i class="fas fa-times-circle mr-1"></i>Denied
                            </span>
                            @break
                            @endswitch
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-center">
                            @if($appointment->status === 'pending')
                            <div class="flex justify-center space-x-2">
                                <form action="{{ route('admin.appointments.approve', $appointment) }}" method="POST">
                                    @csrf
                                    <button
                                        type="submit"
                                        class="bg-green-500 hover:bg-green-600 text-white px-3 py-1.5 rounded-md transition duration-300 flex items-center">
                                        <i class="fas fa-check mr-2"></i>Approve
                                    </button>
                                </form>
                                <form action="{{ route('admin.appointments.deny', $appointment) }}" method="POST">
                                    @csrf
                                    <button
                                        type="submit"
                                        class="bg-red-500 hover:bg-red-600 text-white px-3 py-1.5 rounded-md transition duration-300 flex items-center">
                                        <i class="fas fa-times mr-2"></i>Deny
                                    </button>
                                </form>
                            </div>
                            @else
                            <span class="text-gray-500 italic">No Actions</span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            {{-- Mobile Card View --}}
            <div class="md:hidden">
                @foreach($appointments as $appointment)
                <div class="bg-white p-4 border-b last:border-b-0 hover:bg-gray-50 transition">
                    <div class="flex justify-between items-center mb-3">
                        <div class="flex items-center">
                            <img
                                class="w-10 h-10 rounded-full mr-3"
                                src="{{ $appointment->user->avatar ?? 'https://ui-avatars.com/api/?name=' . urlencode($appointment->user->name) }}"
                                alt="{{ $appointment->user->name }}">
                            <div>
                                <p class="text-sm font-semibold">{{ $appointment->user->name }}</p>
                                <p class="text-xs text-gray-500">{{ $appointment->user->email }}</p>
                            </div>
                        </div>
                        @switch($appointment->status)
                        @case('pending')
                        <span class="px-2 py-1 text-xs bg-yellow-100 text-yellow-800 rounded-full">Pending</span>
                        @break
                        @case('approved')
                        <span class="px-2 py-1 text-xs bg-green-100 text-green-800 rounded-full">Approved</span>
                        @break
                        @case('denied')
                        <span class="px-2 py-1 text-xs bg-red-100 text-red-800 rounded-full">Denied</span>
                        @break
                        @endswitch
                    </div>

                    <div class="text-sm text-gray-600 mb-3">
                        <p class="mb-1"><strong>Car:</strong> {{ $appointment->car->make }} {{ $appointment->car->model }}</p>
                        <p><strong>Date:</strong> {{ \Carbon\Carbon::parse($appointment->appointment_datetime)->format('F j, Y g:i A') }}</p>
                    </div>

                    @if($appointment->status === 'pending')
                    <div class="flex space-x-2">
                        <form action="{{ route('admin.appointments.approve', $appointment) }}" method="POST" class="w-1/2">
                            @csrf
                            <button class="w-full bg-green-500 text-white py-2 rounded-md text-sm flex items-center justify-center">
                                <i class="fas fa-check mr-2"></i>Approve
                            </button>
                        </form>
                        <form action="{{ route('admin.appointments.deny', $appointment) }}" method="POST" class="w-1/2">
                            @csrf
                            <button class="w-full bg-red-500 text-white py-2 rounded-md text-sm flex items-center justify-center">
                                <i class="fas fa-times mr-2"></i>Deny
                            </button>
                        </form>
                    </div>
                    @endif
                </div>
                @endforeach
            </div>
        </div>

        {{-- Responsive Pagination --}}
        <div class="bg-white px-4 py-3 border-t border-gray-200 sm:px-6">
            {{ $appointments->links('vendor.pagination.tailwind') }}
        </div>
        @else
        <div class="text-center py-16 bg-gray-50">
            <i class="fas fa-calendar-times text-6xl text-gray-400 mb-6"></i>
            <p class="text-2xl text-gray-600 mb-2">No appointments to manage</p>
            <p class="text-sm text-gray-500">Check back later for new appointments</p>
        </div>
        @endif
    </div>
</div>

@push('scripts')
<script>
    // Optional: Add search and filter functionality
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('appointment-search');
        const statusFilter = document.getElementById('status-filter');

        // Basic client-side filtering (can be enhanced with AJAX)
        function filterAppointments() {
            const searchTerm = searchInput.value.toLowerCase();
            const statusValue = statusFilter.value;

            const rows = document.querySelectorAll('table tbody tr, .md\\:hidden > div');

            rows.forEach(row => {
                const userText = row.querySelector('.text-sm.font-medium').textContent.toLowerCase();
                const statusSpan = row.querySelector('span');
                const statusText = statusSpan ? statusSpan.textContent.toLowerCase() : '';

                const matchesSearch = userText.includes(searchTerm);
                const matchesStatus = statusValue === '' || statusText.includes(statusValue);

                row.style.display = (matchesSearch && matchesStatus) ? '' : 'none';
            });
        }

        searchInput.addEventListener('input', filterAppointments);
        statusFilter.addEventListener('change', filterAppointments);
    });
</script>
@endpush

@endsection