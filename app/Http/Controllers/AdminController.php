<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Car;
use App\Models\Transaction;
use App\Models\Appointment;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    /**
     * Display a listing of the registered users.
     *
     * @return \Illuminate\View\View
     */
    public function users(Request $request)
    {
        $search = $request->input('search');

        $users = User::when($search, function ($query, $search) {
            return $query->where('name', 'like', '%' . $search . '%')
                ->orWhere('email', 'like', '%' . $search . '%');
        })
            ->paginate(20)->withQueryString();

        return view('admin.users.index', compact('users', 'search'));
    }

    /**
     * Promote a user to administrator.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function promote(User $user)
    {
        if ($user->role === 'admin') {
            return back()->withErrors(['role' => 'User is already an admin.']);
        }

        $user->role = 'admin';
        $user->save();

        return back()->with('success', 'User promoted to admin successfully.');
    }

    public function activateCar(Car $car)
    {
        if ($car->is_active) {
            return back()->withErrors(['status' => 'Car is already active.']);
        }

        $car->is_active = true;
        $car->save();

        return back()->with('success', 'Car listing activated successfully.');
    }

    public function deactivateCar(Car $car)
    {
        if (!$car->is_active) {
            return back()->withErrors(['status' => 'Car is already inactive.']);
        }

        $car->is_active = false;
        $car->save();

        return back()->with('success', 'Car listing deactivated successfully.');
    }

    public function index()
    {
        if (Auth::id()) {
            $userType = Auth::user()->userType;
            if ($userType == "user") {
                return view("home");
            } else {
                $totalUsers = User::count();
                $pendingAppointments = Appointment::where('status', 'pending')->count();
                $activeCars = Car::where('is_active', true)->count();
                $totalTransactions = Transaction::count();

                $recentAppointments = Appointment::with(['user', 'car'])
                    ->latest()
                    ->take(5)
                    ->get();

                $recentTransactions = Transaction::with(['bid', 'bid.user', 'bid.car'])
                    ->latest()
                    ->take(5)
                    ->get();


                $recentTransactions = Transaction::with(['user', 'bid.car'])
                    ->latest()
                    ->take(5)
                    ->get();


                return view('admin.dashboard', compact(
                    'totalUsers',
                    'pendingAppointments',
                    'activeCars',
                    'totalTransactions',
                    'recentAppointments',
                    'recentTransactions'
                ));
            }
        }
    }

    public function cars(Request $request)
    {
        $query = Car::query();

        // Add any admin-specific filtering/sorting here
        $cars = $query->paginate(10);

        return view('admin.cars.index', compact('cars'));
    }
}
