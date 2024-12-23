<?php

namespace App\Http\Controllers;

use App\Models\Bid;
use App\Models\Car;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BidController extends Controller
{
    public function store(Request $request)
    {
        // First check if user role is 'user', not 'admin'
        if (Auth::user()->role === 'admin') {
            return back()->withErrors(['bid' => 'Administrators cannot place bids']);
        }

        $validated = $request->validate([
            'car_id' => 'required|exists:cars,id',
            'bid_amount' => 'required|numeric|min:0',
        ]);

        $car = Car::findOrFail($validated['car_id']);

        // Ensure the car listing is active
        if (!$car->is_active) {
            return back()->withErrors(['car_id' => 'Cannot place a bid on an inactive car.']);
        }

        // Prevent users from bidding on their own listings
        if ($car->user_id === Auth::id()) {
            return back()->withErrors(['car_id' => 'You cannot bid on your own car listing.']);
        }

        // Check if the bid is higher than current highest bid
        $highestBid = $car->bids()->max('bid_amount');
        if ($highestBid && $validated['bid_amount'] <= $highestBid) {
            return back()->withErrors(['bid_amount' => 'Your bid must be higher than the current highest bid ($' . number_format($highestBid, 2) . ')'])->withInput();
        }

        // Create the bid using mass assignment
        Bid::create([
            'user_id' => Auth::id(),
            'car_id' => $validated['car_id'],
            'bid_amount' => $validated['bid_amount']
        ]);

        return back()->with('success', 'Your bid has been placed successfully!');
    }
}
