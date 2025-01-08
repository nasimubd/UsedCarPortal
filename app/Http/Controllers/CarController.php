<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\CarImage;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class CarController extends Controller
{
    use AuthorizesRequests;

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
        // if (!auth()->check() || (auth()->check() && !optional(auth()->user())->isAdmin())) {
        //     $query->where('is_active', true)
        //         // Also show cars owned by the current user
        //         ->orWhere(function ($q) {
        //             $q->where('user_id', auth()->id());
        //         });
        // }

        // Eager load the highestBid relationship
        $cars = $query->with(['highestBid', 'primaryImage'])->paginate(10)->appends(request()->query());

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
        $validated = $request->validate([
            'make' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'registration_year' => 'required|integer|digits:4|min:1900|max:' . (date('Y') + 1),
            'price' => 'required|numeric|min:0',
            'registration_number' => 'required|string|max:20|unique:cars,registration_number',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10120', // 5MB max
        ]);

        // Create car
        $car = Car::create([
            'user_id' => Auth::id(),
            'make' => $validated['make'],
            'model' => $validated['model'],
            'registration_year' => $validated['registration_year'],
            'price' => $validated['price'],
            'registration_number' => $validated['registration_number'],
            'description' => $validated['description'] ?? null,
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageData = base64_encode(file_get_contents($image->getRealPath()));

            CarImage::create([
                'car_id' => $car->id,
                'image_data' => $imageData,
                'mime_type' => $image->getMimeType(),
                'is_primary' => true
            ]);
        }

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
        // Check if the car is inactive
        if (!$car->is_active) {
            // Allow viewing only for the car owner or admin
            if (!Auth::check() || (Auth::user()->id !== $car->user_id &&
                Auth::user()->role !== 'admin')) {
                abort(403, 'You are not authorized to view this listing.');
            }
        }
        // Eager load the highestBid relationship if not already loaded
        if (!$car->relationLoaded('highestBid')) {
            $car->load('highestBid');
        }

        // Eager load the highestBid and primaryImage relationships
        $car->load(['highestBid', 'primaryImage']);
        $primaryImage = $car->primaryImage;
        $highestBid = $car->highestBid;

        return view('cars.show', compact('car', 'highestBid', 'primaryImage'));
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
        $validated = $request->validate([
            'make' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'registration_year' => 'required|integer|digits:4|min:1900|max:' . (date('Y') + 1),
            'price' => 'required|numeric|min:0',
            'registration_number' => 'required|string|max:20|unique:cars,registration_number,' . $car->id,
            'description' => 'nullable|string',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
            'remove_images' => 'sometimes|array',
            'is_primary_image' => 'sometimes|boolean',
        ]);

        // Update car details
        $car->update([
            'make' => $validated['make'],
            'model' => $validated['model'],
            'registration_year' => $validated['registration_year'],
            'price' => $validated['price'],
            'registration_number' => $validated['registration_number'],
            'description' => $validated['description'] ?? null,
        ]);

        // Handle image removal
        if (!empty($validated['remove_images'] ?? [])) {
            CarImage::whereIn('id', $validated['remove_images'])->delete();
        }

        // Handle new image uploads
        if ($request->hasFile('images')) {
            $isPrimarySet = false;
            foreach ($request->file('images') as $image) {
                $imageData = base64_encode(file_get_contents($image->getRealPath()));

                // Set primary image logic
                $isPrimary = false;
                if (
                    !$isPrimarySet &&
                    ($request->has('is_primary_image') ||
                        $car->images()->where('is_primary', true)->doesntExist())
                ) {
                    $isPrimary = true;
                    $isPrimarySet = true;
                }

                CarImage::create([
                    'car_id' => $car->id,
                    'image_data' => $imageData,
                    'mime_type' => $image->getMimeType(),
                    'is_primary' => $isPrimary
                ]);
            }
        }

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

    // In app/Http/Controllers/CarController.php
    public function toggleStatus(Car $car)
    {
        $user = Auth::user();
        // Ensure only the car owner or admin can toggle status
        if ($user->role === 'admin' || $user->id === $car->user_id) {
            $car->is_active = !$car->is_active;
            $car->save();

            return redirect()->route('cars.show', $car)
                ->with('success', 'Car listing ' . ($car->is_active ? 'activated' : 'deactivated') . ' successfully.');
        }

        return redirect()->route('cars.show', $car)
            ->with('error', 'You are not authorized to change this listing status.');
    }


    public function adminIndex(Request $request)
    {
        $query = Car::query();

        // Optional: Add search functionality
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('make', 'like', "%{$search}%")
                    ->orWhere('model', 'like', "%{$search}%")
                    ->orWhere('registration_number', 'like', "%{$search}%");
            });
        }

        $cars = $query->paginate(10);

        return view('admin.cars.index', compact('cars'));
    }

    public function updateCarStatus(Request $request, Car $car)
    {
        $this->authorize('update', $car);

        $validated = $request->validate([
            'is_active' => 'required|boolean'
        ]);

        $car->is_active = $validated['is_active'];
        $car->save();

        return redirect()->route('admin.cars.index')
            ->with('success', 'Car status updated successfully');
    }
}
