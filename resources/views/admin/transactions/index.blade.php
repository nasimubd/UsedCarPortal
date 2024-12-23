@extends('admin.layouts.app')
@vite(['resources/css/app.css', 'resources/js/app.js'])
@section('content')
<h1 class="text-2xl font-semibold mb-6">Manage Transactions</h1>

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

@if($transactions->count())
<table class="min-w-full bg-white">
    <thead>
        <tr>
            <th class="py-2 px-4 border-b">Buyer</th>
            <th class="py-2 px-4 border-b">Car</th>
            <th class="py-2 px-4 border-b">Final Price</th>
            <th class="py-2 px-4 border-b">Bid Amount</th>
            <th class="py-2 px-4 border-b">Transaction Date</th>
            <th class="py-2 px-4 border-b">Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($transactions as $transaction)
        <tr class="text-center">
            <td class="py-2 px-4 border-b">{{ $transaction->buyer->name }}</td>
            <td class="py-2 px-4 border-b">{{ $transaction->car->make }} {{ $transaction->car->model }}</td>
            <td class="py-2 px-4 border-b">${{ number_format($transaction->final_price, 2) }}</td>
            <td class="py-2 px-4 border-b">${{ number_format($transaction->bid->bid_amount, 2) }}</td>
            <td class="py-2 px-4 border-b">{{ $transaction->created_at->format('Y-m-d H:i') }}</td>
            <td class="py-2 px-4 border-b">
                <a href="{{ route('admin.transactions.show', $transaction) }}" class="text-blue-500 hover:underline">View</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<div class="mt-6">
    {{ $transactions->links() }}
</div>
@else
<p class="text-center text-gray-600">No transactions found.</p>
@endif
@endsection