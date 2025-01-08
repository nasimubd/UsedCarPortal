@extends('admin.layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <h1 class="text-2xl font-semibold mb-6">Invoices</h1>

        @if($invoices->count())
        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left">Invoice ID</th>
                        <th class="px-6 py-3 text-left">User</th>
                        <th class="px-6 py-3 text-left">Car</th>
                        <th class="px-6 py-3 text-left">Amount</th>
                        <th class="px-6 py-3 text-left">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($invoices as $invoice)
                    <tr>
                        <td class="px-6 py-4">{{ $invoice->id }}</td>
                        <td class="px-6 py-4">{{ $invoice->user->name }}</td>
                        <td class="px-6 py-4">{{ $invoice->car->make }} {{ $invoice->car->model }}</td>
                        <td class="px-6 py-4">${{ number_format($invoice->amount, 2) }}</td>
                        <td class="px-6 py-4">
                            <a href="{{ route('invoices.show', $invoice) }}" class="text-blue-500 hover:underline">View</a>
                            <form action="{{ route('admin.invoices.resend', $invoice) }}" method="POST" class="inline">
                                @csrf
                                <button type="submit" class="text-green-500 hover:underline ml-2">Resend</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @else
        <p>No invoices found.</p>
        @endif
    </div>
</div>
@endsection