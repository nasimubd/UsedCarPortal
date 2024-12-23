<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Car;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the user's appointments.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $appointments = Appointment::with('user')->get();
        return view('appointments.index', compact('appointments'));
    }


    /**
     * Show the form for creating a new appointment.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $cars = Car::where('is_active', true)->get();
        return view('appointments.create', compact('cars'));
    }

    /**
     * Store a newly created appointment in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'car_id' => 'required|exists:cars,id',
            'appointment_time' => 'required|date|after:now',
        ]);

        // Check for overlapping appointments
        $overlap = Appointment::where('user_id', Auth::id())
            ->where('appointment_time', $validated['appointment_time'])
            ->exists();

        if ($overlap) {
            return back()->withErrors(['appointment_time' => 'You already have an appointment at this time.'])->withInput();
        }

        Appointment::create([
            'user_id' => Auth::id(),
            'car_id' => $validated['car_id'],
            'appointment_time' => $validated['appointment_time'],
            'status' => 'pending',
        ]);

        return redirect()->route('appointments.index')->with('success', 'Appointment booked successfully! Awaiting approval.');
    }

    /**
     * Display the specified appointment.
     *
     * @param  \App\Models\Appointment  $appointment
     * @return \Illuminate\View\View
     */
    public function show(Appointment $appointment)
    {
        // Ensure the user owns the appointment or is an admin

        // if (Auth::user() instanceof \App\Models\User && !Auth::user()->isAdmin()) {
        //     abort(403, 'Unauthorized action.');
        // }

        $appointment->load('car', 'user');
        return view('appointments.show', compact('appointment'));
    }

    /**
     * Display a listing of all appointments for admin.
     *
     * @return \Illuminate\View\View
     */
    public function adminIndex()
    {
        $appointments = Appointment::with('car', 'user')->orderBy('appointment_time', 'desc')->paginate(20);
        return view('admin.appointments.index', compact('appointments'));
    }

    /**
     * Approve an appointment.
     *
     * @param  \App\Models\Appointment  $appointment
     * @return \Illuminate\Http\RedirectResponse
     */
    public function approve(Appointment $appointment)
    {
        if ($appointment->status !== 'pending') {
            return back()->withErrors(['status' => 'Only pending appointments can be approved.']);
        }

        // Example Criteria: Check if the appointment's user bid is the highest
        $highestBid = $appointment->car->bids()->max('bid_amount');
        $userBid = $appointment->car->bids()->where('user_id', $appointment->user_id)->max('bid_amount');

        if ($userBid < $highestBid) {
            return back()->withErrors(['bid_amount' => 'Cannot approve appointment. Your bid is not the highest.']);
        }

        $appointment->status = 'approved';
        $appointment->save();

        // Optionally, notify the user via email or notification

        return back()->with('success', 'Appointment approved successfully.');
    }

    /**
     * Deny an appointment.
     *
     * @param  \App\Models\Appointment  $appointment
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deny(Appointment $appointment)
    {
        if ($appointment->status !== 'pending') {
            return back()->withErrors(['status' => 'Only pending appointments can be denied.']);
        }

        $appointment->status = 'denied';
        $appointment->save();

        // Optionally, notify the user via email or notification

        return back()->with('success', 'Appointment denied successfully.');
    }
}
