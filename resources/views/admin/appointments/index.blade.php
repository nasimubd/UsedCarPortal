@extends('admin.layouts.app')

@section('content')
<h1 class="text-2xl font-semibold mb-6">Manage Appointments</h1>

<!-- Success and Error Messages -->
@if(session('success'))
<div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
    {{ session('success') }}
</div>
@endif

@if ($errors->any())
<div class="mb-4">
    <ul class="list-disc list-inside text-red-500">
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

@if($appointments->count())
<table class="min-w-full bg-white">
    <thead>
        <tr>
            <th class="py-2 px-4 border-b">User</th>
            <th class="py-2 px-4 border-b">Car</th>
            <th class="py-2 px-4 border-b">Appointment Time</th>
            <th class="py-2 px-4 border-b">Status</th>
            <th class="py-2 px-4 border-b">Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($appointments as $appointment)
        <tr class="text-center">
            <td class="py-2 px-4 border-b">{{ $appointment->user->name }}</td>
            <td class="py-2 px-4 border-b">{{ $appointment->car->make }} {{ $appointment->car->model }}</td>
            <td class="py-2 px-4 border-b">{{ $appointment->appointment_time->format('Y-m-d H:i') }}</td>
            <td class="py-2 px-4 border-b">
                @if($appointment->status === 'pending')
                <span class="text-yellow-500 font-semibold">Pending</span>
                @elseif($appointment->status === 'approved')
                <span class="text-green-500 font-semibold">Approved</span>
                @elseif($appointment->status === 'denied')
                <span class="text-red-500 font-semibold">Denied</span>
                @endif
            </td>
            <td class="py-2 px-4 border-b">
                @if($appointment->status === 'pending')
                <form action="{{ route('admin.appointments.update', $appointment) }}" method="POST" class="inline-block">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="status" value="approved">
                    <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-1 px-2 rounded">
                        Approve
                    </button>
                </form>

                <form action="{{ route('admin.appointments.update', $appointment) }}" method="POST" class="inline-block">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="status" value="denied">
                    <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded">
                        Deny
                    </button>
                </form>
                @else
                <span class="text-gray-500">N/A</span>
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<div class="mt-6">
    {{ $appointments->links() }}
</div>
@else
<p class="text-center text-gray-600">No appointments found.</p>
@endif
@endsection