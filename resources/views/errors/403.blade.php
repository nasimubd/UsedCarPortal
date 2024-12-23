@extends('layouts.app')

@section('title', __('Forbidden'))

@section('content')
<div class="flex items-center justify-center h-screen bg-gray-100">
    <div class="max-w-md w-full bg-white shadow-md rounded px-8 py-6">
        <h1 class="text-3xl font-bold mb-4">403 - Forbidden</h1>
        <p class="text-gray-700 mb-6">You do not have permission to access this page.</p>
        <a href="{{ url()->previous() }}" class="text-blue-500 hover:underline">Go Back</a>
    </div>
</div>
@endsection