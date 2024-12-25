<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CarController extends Controller
{
    /**
     * Display a listing of the cars with search functionality.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        // Retrieve search parameters
        $searchMake = $request->input('make');
        $searchModel = $request->input('model');
        $searchYear = $request->input('registration_year');
        $priceMin = $request->input('price_min');
        $priceMax = $request->input('price_max');

        // Initialize the query using renamed scopes
        $query = Car::query()
            ->when($searchMake, function ($q) use ($searchMake) {
                return $q->filterMake($searchMake);
            })
            ->when($searchModel, function ($q) use ($searchModel) {
                return $q->filterModel($searchModel);
            })
            ->when($searchYear, function ($q) use ($searchYear) {
                return $q->filterRegistrationYear($searchYear);
            })
            ->when($priceMin, function ($q) use ($priceMin) {
                return $q->filterPriceMin($priceMin);
            })
            ->when($priceMax, function ($q) use ($priceMax) {
                return $q->filterPriceMax($priceMax);
            });

        // For general users, show only active listings
        // if (!Auth::check() || (Auth::check() && !Auth::user()->isAdmin())) {
        //     $query->where('is_active', true);
        // }

        // Eager load the highestBid relationship
        $cars = $query->with(['highestBid'])->paginate(10)->appends(request()->query());

        return view('cars.index', compact('cars', 'searchMake', 'searchModel', 'searchYear', 'priceMin', 'priceMax'));
    }

    /**
     * Show the form for creating a new car.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('cars.create');
    }

    /**
     * Store a newly created car in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Validate the request
        $validated = $request->validate([
            'make' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'registration_year' => 'required|integer|digits:4|min:1900|max:' . (date('Y') + 1),
            'price' => 'required|numeric|min:0',
            'registration_number' => 'required|string|max:20|unique:cars,registration_number',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle image upload if present
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('car_images', 'public');
            $validated['image_path'] = $path;
        }

        // Assign the authenticated user's ID
        $validated['user_id'] = Auth::id();

        // Create the car listing
        Car::create($validated);

        return redirect()->route('cars.index')->with('success', 'Car posted successfully!');
    }

    /**
     * Display the specified car.
     *
     * @param  \App\Models\Car  $car
     * @return \Illuminate\View\View
     */
    public function show(Car $car)
    {
        // Eager load the highestBid relationship if not already loaded
        if (!$car->relationLoaded('highestBid')) {
            $car->load('highestBid');
        }

        $highestBid = $car->highestBid;

        return view('cars.show', compact('car', 'highestBid'));
    }

    /**
     * Show the form for editing the specified car.
     *
     * @param  \App\Models\Car  $car
     * @return \Illuminate\View\View|\Illuminate\Http\Response
     */
    public function edit(Car $car)
    {
        // Check if the authenticated user is the owner or an admin
        // if (Auth::id() !== $car->user_id && !Auth::user()->isAdmin()) {
        //     abort(403, 'Unauthorized action.');
        // }

        return view('cars.edit', compact('car'));
    }

    /**
     * Update the specified car in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Car  $car
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Car $car)
    {
        // Check if the authenticated user is the owner or an admin
        // if (Auth::id() !== $car->user_id && !Auth::user()->isAdmin()) {
        //     abort(403, 'Unauthorized action.');
        // }

        // Validate the request
        $validated = $request->validate([
            'make' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'registration_year' => 'required|integer|digits:4|min:1900|max:' . (date('Y') + 1),
            'price' => 'required|numeric|min:0',
            'registration_number' => 'required|string|max:20|unique:cars,registration_number,' . $car->id,
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_active' => 'sometimes|boolean',
        ]);

        // Handle image upload if present
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($car->image_path && Storage::disk('public')->exists($car->image_path)) {
                Storage::disk('public')->delete($car->image_path);
            }

            $path = $request->file('image')->store('car_images', 'public');
            $validated['image_path'] = $path;
        }

        // Update the car listing
        $car->update($validated);

        return redirect()->route('cars.show', $car)->with('success', 'Car updated successfully!');
    }

    /**
     * Remove the specified car from storage (soft delete or deactivate).
     *
     * @param  \App\Models\Car  $car
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Car $car)
    {
        // Check if the authenticated user is the owner or an admin
        // if (Auth::id() !== $car->user_id && !Auth::user()->isAdmin()) {
        //     abort(403, 'Unauthorized action.');
        // }

        // Option 1: Soft delete (requires SoftDeletes trait)
        // $car->delete();

        // Option 2: Deactivate the car listing
        $car->is_active = false;
        $car->save();

        return redirect()->route('cars.index')->with('success', 'Car listing deactivated successfully!');
    }
}
