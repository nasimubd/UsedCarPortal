@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        @if(session('success'))
        <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
            {{ session('success') }}
        </div>
        @endif

        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-semibold">Manage Transactions</h1>
        </div>

        @if($transactions->count())
        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Invoice ID</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">User</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Car</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Bid Amount ($)</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($transactions as $transaction)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">
                            {{ $transaction->id }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            {{ $transaction->bid->user->name }} ({{ $transaction->bid->user->email }})
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            {{ $transaction->bid->car->make }} {{ $transaction->bid->car->model }} ({{ $transaction->bid->car->registration_year }})
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            ${{ number_format($transaction->bid->amount, 2) }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($transaction->status === 'pending')
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                Pending
                            </span>
                            @elseif($transaction->status === 'approved')
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                Approved
                            </span>
                            @elseif($transaction->status === 'denied')
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                Denied
                            </span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                            @if($transaction->status === 'pending')
                            <form action="{{ route('admin.transactions.sell', $transaction) }}" method="POST" class="inline-block">
                                @csrf
                                <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-1 px-3 rounded">
                                    Sell
                                </button>
                            </form>

                            <form action="{{ route('admin.transactions.deny', $transaction) }}" method="POST" class="inline-block ml-2">
                                @csrf
                                <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-3 rounded">
                                    Deny
                                </button>
                            </form>
                            @else
                            <span class="text-gray-500">No Actions</span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-6">
            {{ $transactions->links() }}
        </div>
        @else
        <p class="text-center text-gray-600">There are no transactions to manage.</p>
        @endif
    </div>
</div>
@endsection