<?php

namespace App\Http\Controllers;

use App\Models\Bid;
use App\Models\Car;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    /**
     * Display a listing of the transactions.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $transactions = Transaction::with('bid', 'car', 'buyer')->orderBy('created_at', 'desc')->paginate(20);
        return view('admin.transactions.index', compact('transactions'));
    }

    /**
     * Finalize a transaction based on a bid.
     *
     * @param  \App\Models\Bid  $bid
     * @return \Illuminate\Http\RedirectResponse
     */
    public function finalize(Bid $bid)
    {
        // Ensure the bid is the highest for the car
        $highestBid = $bid->car->bids()->max('bid_amount');
        if ($bid->bid_amount < $highestBid) {
            return back()->withErrors(['bid_amount' => 'Cannot finalize transaction. This bid is not the highest.']);
        }

        // Check if a transaction already exists for this car
        if ($bid->car->transaction) {
            return back()->withErrors(['transaction' => 'A transaction has already been finalized for this car.']);
        }

        // Create the transaction
        Transaction::create([
            'bid_id' => $bid->id,
            'car_id' => $bid->car_id,
            'buyer_id' => $bid->user_id,
            'final_price' => $bid->bid_amount,
        ]);

        // Mark the car as inactive (sold)
        $bid->car->is_active = false;
        $bid->car->save();

        // Optionally, notify the buyer via email or notification

        return back()->with('success', 'Transaction finalized successfully.');
    }
}
