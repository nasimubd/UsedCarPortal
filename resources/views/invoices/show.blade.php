@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white shadow-md rounded-lg p-6">
            <h1 class="text-2xl font-semibold mb-4">Invoice #{{ $invoice->id }}</h1>

            <div class="mb-4">
                <h2 class="text-xl font-bold">User:</h2>
                <p>{{ $invoice->user->name }} ({{ $invoice->user->email }})</p>
            </div>

            <div class="mb-4">
                <h2 class="text-xl font-bold">Car:</h2>
                <p>{{ $invoice->car->make }} {{ $invoice->car->model }} ({{ $invoice->car->registration_year }})</p>
            </div>

            <div class="mb-4">
                <h2 class="text-xl font-bold">Amount:</h2>
                <p>${{ number_format($invoice->amount, 2) }}</p>
            </div>

            <div class="mb-4">
                <h2 class="text-xl font-bold">Payment Details:</h2>
                <p>{{ $invoice->payment_details }}</p>
            </div>

            <div class="mb-4">
                <h2 class="text-xl font-bold">Transaction Date:</h2>
                <p>{{ $invoice->created_at->format('F j, Y') }}</p>
            </div>

            <div class="flex justify-end">
                <a href="{{ route('admin.transactions.index') }}" class="text-blue-500 hover:underline">← Back to Transactions</a>
            </div>
        </div>
    </div>
</div>
@endsection