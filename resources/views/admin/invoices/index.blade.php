@extends('admin.layouts.app')

@section('content')
<div class="py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-7xl mx-auto">
        <!-- Dashboard Header -->
        <div class="flex flex-col md:flex-row justify-between items-center mb-8">
            <div class="flex items-center space-x-4">
                <div class="bg-gradient-to-r from-blue-600 to-purple-600 p-3 rounded-2xl shadow-lg">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 14l6-6m-5.5.5h.01m4.99 5h.01M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16l3.5-2 3.5 2 3.5-2 3.5 2z" />
                    </svg>
                </div>
                <div>
                    <h1 class="text-3xl font-extrabold bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">Invoices</h1>
                    <p class="text-gray-500">Manage and track all transaction records</p>
                </div>
            </div>

            <!-- Search Bar -->
            <div class="relative mt-4 md:mt-0 w-full md:w-96">
                <input type="search" placeholder="Search invoices..."
                    class="w-full pl-12 pr-4 py-3 rounded-xl border-2 border-gray-200 focus:border-blue-500 focus:ring-4 focus:ring-blue-100 transition-all duration-300">
                <svg class="w-6 h-6 text-gray-400 absolute left-3 top-1/2 transform -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </div>
        </div>

        @if($invoices->count())
        <div class="bg-white shadow-2xl rounded-2xl overflow-hidden border border-gray-100">
            <!-- Desktop View -->
            <div class="hidden md:block overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="bg-gradient-to-r from-blue-500 to-purple-600">
                            <th class="px-6 py-4 text-left text-white font-semibold">Invoice ID</th>
                            <th class="px-6 py-4 text-left text-white font-semibold">User</th>
                            <th class="px-6 py-4 text-left text-white font-semibold">Car Details</th>
                            <th class="px-6 py-4 text-left text-white font-semibold">Amount</th>
                            <th class="px-6 py-4 text-left text-white font-semibold">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($invoices as $invoice)
                        <tr class="border-b hover:bg-gray-50 transition-all duration-200">
                            <td class="px-6 py-4">
                                <span class="bg-blue-100 text-blue-800 text-sm font-medium px-3 py-1 rounded-full">#{{ $invoice->id }}</span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center space-x-3">
                                    <div class="w-10 h-10 rounded-lg bg-gradient-to-br from-blue-500 to-purple-600 text-white flex items-center justify-center font-bold shadow-lg">
                                        {{ strtoupper(substr($invoice->user->name, 0, 1)) }}
                                    </div>
                                    <span class="font-medium">{{ $invoice->user->name }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="font-medium text-gray-800">{{ $invoice->car->make }} {{ $invoice->car->model }}</div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="bg-gradient-to-r from-green-500 to-emerald-500 text-white px-4 py-2 rounded-full text-sm font-bold shadow-lg">
                                    ${{ number_format($invoice->amount, 2) }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex space-x-3">
                                    <a href="{{ route('invoices.show', $invoice) }}"
                                        class="px-4 py-2 bg-blue-100 text-blue-600 rounded-lg hover:bg-blue-200 transition-all duration-200">
                                        View
                                    </a>
                                    <form action="{{ route('admin.invoices.resend', $invoice) }}" method="POST" class="inline">
                                        @csrf
                                        <button type="submit"
                                            class="px-4 py-2 bg-green-100 text-green-600 rounded-lg hover:bg-green-200 transition-all duration-200">
                                            Resend
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Mobile View -->
            <div class="md:hidden divide-y divide-gray-200">
                @foreach($invoices as $invoice)
                <div class="p-4 space-y-3">
                    <div class="flex justify-between items-start">
                        <div class="flex items-center space-x-3">
                            <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-blue-500 to-purple-600 text-white flex items-center justify-center font-bold text-lg shadow-lg">
                                {{ strtoupper(substr($invoice->user->name, 0, 1)) }}
                            </div>
                            <div>
                                <div class="font-semibold text-gray-800">{{ $invoice->user->name }}</div>
                                <div class="text-sm text-gray-500">{{ $invoice->car->make }} {{ $invoice->car->model }}</div>
                                <div class="text-xs text-blue-600">#{{ $invoice->id }}</div>
                            </div>
                        </div>
                        <span class="bg-gradient-to-r from-green-500 to-emerald-500 text-white px-3 py-1 rounded-full text-sm font-bold shadow-lg">
                            ${{ number_format($invoice->amount, 2) }}
                        </span>
                    </div>
                    <div class="flex justify-end space-x-2 pt-2">
                        <a href="{{ route('invoices.show', $invoice) }}"
                            class="px-3 py-1 bg-blue-100 text-blue-600 rounded-lg text-sm">
                            View
                        </a>
                        <form action="{{ route('admin.invoices.resend', $invoice) }}" method="POST" class="inline">
                            @csrf
                            <button type="submit"
                                class="px-3 py-1 bg-green-100 text-green-600 rounded-lg text-sm">
                                Resend
                            </button>
                        </form>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @else
        <div class="bg-white rounded-2xl shadow-2xl p-12 text-center">
            <div class="w-24 h-24 bg-gradient-to-r from-blue-500 to-purple-600 rounded-full mx-auto flex items-center justify-center mb-6">
                <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 14l6-6m-5.5.5h.01m4.99 5h.01M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16l3.5-2 3.5 2 3.5-2 3.5 2z" />
                </svg>
            </div>
            <h2 class="text-3xl font-bold bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">No Invoices Found</h2>
            <p class="mt-2 text-gray-500 text-lg">Start generating invoices by completing transactions.</p>
        </div>
        @endif
    </div>
</div>
@endsection