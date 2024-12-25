<?php

namespace App\Http\Controllers;

use App\Models\Bid;
use App\Models\Car;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use App\Notifications\BidPlaced;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class BidController extends Controller
{
    use AuthorizesRequests;
    /**
     * Display a listing of the user's bids.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $userId = Auth::id();
        $bids = Bid::where('user_id', $userId)->with('car')->latest()->paginate(10);
        return view('bids.index', compact('bids'));
    }

    /**
     * Show the form for creating a new bid.
     *
     * @return \Illuminate\View\View
     */
    /**
     * Show the form for creating a new bid.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $this->authorize('create', Bid::class);

        $cars = Car::where('is_active', true)->get();
        return view('bids.create', compact('cars'));
    }

    /**
     * Store a newly created bid in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $this->authorize('create', Bid::class);

        // Validate the request
        $validated = $request->validate([
            'car_id' => 'required|exists:cars,id',
            'amount' => 'required|numeric|min:0',
        ]);

        $car = Car::findOrFail($validated['car_id']);

        // Check if the car is active
        if (!$car->is_active) {
            return redirect()->back()->withErrors(['car_id' => 'Cannot bid on an inactive car.'])->withInput();
        }

        // Get the current highest bid
        $highestBid = $car->bids()->max('amount');

        // Ensure the new bid is higher than the current highest bid
        if ($validated['amount'] <= $highestBid) {
            return redirect()->back()->withErrors(['amount' => 'Your bid must be higher than the current highest bid ($' . number_format($highestBid, 2) . ').'])->withInput();
        }

        // Create the bid
        Bid::create([
            'user_id' => Auth::id(),
            'car_id' => $validated['car_id'],
            'amount' => $validated['amount'],
        ]);

        return redirect()->route('bids.index')->with('success', 'Bid placed successfully!');
    }

    /**
     * Display the specified bid.
     *
     * @param  \App\Models\Bid  $bid
     * @return \Illuminate\View\View|\Illuminate\Http\Response
     */
    public function show(Bid $bid)
    {
        $this->authorize('view', $bid);

        return view('bids.show', compact('bid'));
    }

    /**
     * Display a listing of all bids for admins.
     *
     * @return \Illuminate\View\View
     */
    public function adminIndex()
    {
        $this->authorize('viewAny', Bid::class);

        $bids = Bid::with(['user', 'car'])->latest()->paginate(20);
        return view('admin.bids.index', compact('bids'));
    }
}
