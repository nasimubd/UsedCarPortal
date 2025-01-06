@extends('admin.layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-7xl mx-auto">
        {{-- Animated Header --}}
        <div class="mb-8 text-center">
            <h1 class="text-4xl font-extrabold text-gray-900 sm:text-5xl md:text-6xl 
                       bg-clip-text text-transparent bg-gradient-to-r from-blue-600 to-purple-600 
                       animate-pulse">
                Transaction Management
            </h1>
            <p class="mt-3 text-base text-gray-500 sm:mt-5 sm:text-lg sm:max-w-xl sm:mx-auto md:mt-5">
                Manage and track all car transaction details with ease
            </p>
        </div>

        {{-- Success Notification --}}
        @if(session('success'))
        <div class="mb-6">
            <div class="bg-green-50 border-l-4 border-green-400 p-4 animate-bounce">
                <div class="flex">
                    <div class="ml-3">
                        <p class="text-sm text-green-700">
                            {{ session('success') }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
        @endif

        {{-- Transactions Card --}}
        <div class="bg-white shadow-2xl rounded-2xl overflow-hidden transform transition-all 
                    hover:scale-[1.01] hover:shadow-3xl duration-300">
            {{-- Responsive Table --}}
            @if($transactions->count())
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gradient-to-r from-blue-500 to-purple-600">
                        <tr>
                            @php
                            $headers = [
                            'Invoice ID', 'User', 'Car', 'Bid Amount', 'Status', 'Actions'
                            ];
                            @endphp
                            @foreach($headers as $header)
                            <th class="px-6 py-4 text-left text-xs font-bold text-white uppercase tracking-wider">
                                {{ $header }}
                            </th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($transactions as $transaction)
                        <tr class="hover:bg-gray-50 transition duration-200">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                <div class="flex items-center">
                                    <span class="font-medium">#{{ $transaction->id }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900">
                                            {{ $transaction->bid->user->name }}
                                        </div>
                                        <div class="text-sm text-gray-500">
                                            {{ $transaction->bid->user->email }}
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                {{ $transaction->bid->car->make }}
                                {{ $transaction->bid->car->model }}
                                ({{ $transaction->bid->car->registration_year }})
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700 font-semibold">
                                ${{ number_format($transaction->bid->amount, 2) }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @php
                                $statusClasses = [
                                'pending' => 'bg-yellow-100 text-yellow-800',
                                'approved' => 'bg-green-100 text-green-800',
                                'denied' => 'bg-red-100 text-red-800'
                                ];
                                @endphp
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                    {{ $statusClasses[$transaction->status] }}">
                                    {{ ucfirst($transaction->status) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                                @if($transaction->status === 'pending')
                                <div class="flex justify-center space-x-2">
                                    <form action="{{ route('admin.transactions.sell', $transaction) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="bg-green-500 hover:bg-green-600 
                                            text-white py-2 px-4 rounded-lg transition duration-300 
                                            transform hover:scale-105 focus:outline-none">
                                            Sell
                                        </button>
                                    </form>
                                    <form action="{{ route('admin.transactions.deny', $transaction) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="bg-red-500 hover:bg-red-600 
                                            text-white py-2 px-4 rounded-lg transition duration-300 
                                            transform hover:scale-105 focus:outline-none">
                                            Deny
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
            </div>

            {{-- Responsive Pagination --}}
            <div class="bg-gray-50 px-4 py-4 sm:px-6">
                {{ $transactions->links('vendor.pagination.tailwind') }}
            </div>
            @else
            {{-- Empty State --}}
            <div class="text-center py-16 bg-gray-50">
                <svg class="mx-auto h-20 w-20 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" />
                </svg>
                <p class="mt-4 text-2xl text-gray-600 mb-2">No Transactions Found</p>
                <p class="text-sm text-gray-500">Check back later for new transactions</p>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    @keyframes pulse-animation {
        0% {
            transform: scale(1);
        }

        50% {
            transform: scale(1.05);
        }

        100% {
            transform: scale(1);
        }
    }

    .animate-pulse {
        animation: pulse-animation 2s infinite;
    }
</style>
@endpush