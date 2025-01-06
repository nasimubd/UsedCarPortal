@extends('admin.layouts.app')

@section('content')
<div class="container mx-auto px-4 sm:px-6 lg:px-8">
    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <!-- Gradient Header -->
        <div class="p-6 bg-gradient-to-r from-blue-500 to-purple-600">
            <h1 class="text-3xl font-bold text-white">Car Listings Management</h1>
        </div>

        <!-- Alerts Section -->
        <div class="p-4">
            @if(session('success'))
            <div class="mb-4 bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded" role="alert">
                <div class="flex items-center">
                    <svg class="h-6 w-6 mr-4 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <p class="font-bold">Success</p>
                    <p class="ml-2">{{ session('success') }}</p>
                </div>
            </div>
            @endif

            @if ($errors->any())
            <div class="mb-4 bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded" role="alert">
                <div class="flex items-center">
                    <svg class="h-6 w-6 mr-4 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                    <div>
                        <p class="font-bold">Error</p>
                        <ul class="list-disc list-inside">
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            @endif
        </div>

        <!-- Search and Filter Section -->
        <div class="p-4 bg-gray-50 border-b">
            <form action="{{ route('admin.cars.index') }}" method="GET" class="flex flex-col md:flex-row space-y-2 md:space-y-0 md:space-x-4">
                <div class="relative flex-grow">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <input type="text" name="search" value="{{ request('search') }}"
                        placeholder="Search by make, model, or registration number"
                        class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md leading-5 bg-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-300">
                </div>
                <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-md transition duration-300 ease-in-out transform hover:scale-105">
                    Search
                </button>
            </form>
        </div>

        <!-- Cars Listing -->
        @if($cars->count())
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 p-6">
            @foreach($cars as $car)
            <div class="bg-white rounded-xl shadow-lg overflow-hidden transform transition hover:scale-105 hover:shadow-2xl duration-300">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-4">
                        <h2 class="text-xl font-bold text-gray-800">{{ $car->make }} {{ $car->model }}</h2>
                        <span class="px-3 py-1 rounded-full text-xs font-semibold 
                            {{ $car->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                            {{ $car->is_active ? 'Active' : 'Inactive' }}
                        </span>
                    </div>

                    <div class="space-y-2 text-gray-600">
                        <p><strong>Year:</strong> {{ $car->registration_year }}</p>
                        <p><strong>Price:</strong> ${{ number_format($car->price, 2) }}</p>
                        <p><strong>Reg. Number:</strong> {{ $car->registration_number }}</p>
                    </div>

                    <div class="mt-6 flex space-x-2">
                        <form action="{{ route('admin.cars.status.update', $car) }}" method="POST" class="flex-grow">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="is_active" value="{{ $car->is_active ? 0 : 1 }}">
                            <button type="submit" class="w-full {{ $car->is_active ? 'bg-red-500 hover:bg-red-600' : 'bg-green-500 hover:bg-green-600' }} text-white font-bold py-2 rounded-md transition duration-300 ease-in-out">
                                {{ $car->is_active ? 'Deactivate' : 'Activate' }}
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="bg-gray-50 px-4 py-3 flex items-center justify-between border-t border-gray-200 sm:px-6">
            {{ $cars->links('vendor.pagination.tailwind') }}
        </div>
        @else
        <div class="text-center py-16 bg-gray-50">
            <svg class="mx-auto h-24 w-24 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 005.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <h2 class="mt-6 text-2xl font-semibold text-gray-600">No Car Listings Found</h2>
            <p class="mt-2 text-gray-500">Try adjusting your search criteria</p>
        </div>
        @endif
    </div>
</div>
@endsection