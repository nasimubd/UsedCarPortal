@extends('admin.layouts.app')

@vite(['resources/css/app.css', 'resources/js/app.js'])

@section('content')
<h1 class="text-2xl font-semibold mb-6">Manage Users</h1>

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

<!-- Search Form -->
<form action="{{ route('admin.users.index') }}" method="GET" class="mb-6">
    <input type="text" name="search" value="{{ $search }}" placeholder="Search by name or email" class="w-full border rounded px-3 py-2">
</form>

@if($users->count())
<table class="min-w-full bg-white">
    <thead>
        <tr>
            <th class="py-2 px-4 border-b">Name</th>
            <th class="py-2 px-4 border-b">Email</th>
            <th class="py-2 px-4 border-b">Role</th>
            <th class="py-2 px-4 border-b">Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($users as $user)
        <tr class="text-center">
            <td class="py-2 px-4 border-b">{{ $user->name }}</td>
            <td class="py-2 px-4 border-b">{{ $user->email }}</td>
            <td class="py-2 px-4 border-b">{{ ucfirst($user->role) }}</td>
            <td class="py-2 px-4 border-b">
                @if($user->role !== 'admin')
                <form action="{{ route('admin.users.update', $user) }}" method="POST" class="inline-block">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="role" value="admin">
                    <button type="submit" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-1 px-2 rounded">
                        Promote to Admin
                    </button>
                </form>
                @else
                <span class="text-green-500 font-semibold">Admin</span>
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<div class="mt-6">
    {{ $users->links() }}
</div>
@else
<p class="text-center text-gray-600">No users found.</p>
@endif
@endsection