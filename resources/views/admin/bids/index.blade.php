@extends('admin.layouts.app')

@section('content')
<h1 class="text-2xl font-semibold mb-6">All Bids</h1>

<table class="min-w-full bg-white">
    <thead>
        <tr>
            <th class="py-2 px-4 border-b">User</th>
            <th class="py-2 px-4 border-b">Car</th>
            <th class="py-2 px-4 border-b">Bid Amount</th>
            <th class="py-2 px-4 border-b">Date</th>
        </tr>
    </thead>
    <tbody>
        @foreach($bids as $bid)
        <tr class="text-center">
            <td class="py-2 px-4 border-b">{{ $bid->user->name }}</td>
            <td class="py-2 px-4 border-b">{{ $bid->car->make }} {{ $bid->car->model }}</td>
            <td class="py-2 px-4 border-b">${{ number_format($bid->bid_amount, 2) }}</td>
            <td class="py-2 px-4 border-b">{{ $bid->created_at->format('Y-m-d H:i') }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

<div class="mt-6">
    {{ $bids->links() }}
</div>
@endsection