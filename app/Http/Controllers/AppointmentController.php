<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Car;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use App\Notifications\AppointmentStatusChanged;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the user's appointments.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $user = Auth::user();

        $appointments = Appointment::query()
            ->where('user_id', $user->id)
            ->with(['car' => function ($query) {
                $query->select('id', 'make', 'model', 'registration_year');
            }])
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('appointments.index', [
            'appointments' => $appointments
        ]);
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
        // Validate the request
        $validated = $request->validate([
            'car_id' => 'required|exists:cars,id',
            'appointment_datetime' => 'required|date|after:now',
        ]);

        // Check if the user has already booked an appointment for the same car at the same time
        $existingAppointment = Appointment::where('user_id', Auth::id())
            ->where('car_id', $validated['car_id'])
            ->where('appointment_datetime', $validated['appointment_datetime'])
            ->first();

        if ($existingAppointment) {
            return redirect()->back()->withErrors(['appointment_datetime' => 'You have already booked an appointment for this car at the selected time.'])->withInput();
        }

        // Create the appointment
        Appointment::create([
            'user_id' => Auth::id(),
            'car_id' => $validated['car_id'],
            'appointment_datetime' => $validated['appointment_datetime'],
            'status' => 'pending',
        ]);

        return redirect()->route('appointments.index')->with('success', 'Appointment booked successfully and is pending approval.');
    }

    /**
     * Display the specified appointment.
     *
     * @param  \App\Models\Appointment  $appointment
     * @return \Illuminate\View\View|\Illuminate\Http\Response
     */
    public function show(Appointment $appointment)
    {
        // Ensure that the user owns the appointment or is an admin
        if (Auth::check() && Auth::user()->role === 'admin') {
            abort(403, 'Unauthorized action.');
        }

        return view('appointments.show', compact('appointment'));
    }

    /**
     * Display a listing of all appointments for admins.
     *
     * @return \Illuminate\View\View
     */
    public function adminIndex()
    {
        $appointments = Appointment::with(['user', 'car'])->latest()->paginate(20);
        return view('admin.appointments.index', compact('appointments'));
    }

    /**
     * Approve the specified appointment.
     *
     * @param  \App\Models\Appointment  $appointment
     * @return \Illuminate\Http\RedirectResponse
     */
    public function approve(Appointment $appointment)
    {
        if ($appointment->status !== 'pending') {
            return redirect()->back()->withErrors(['status' => 'Only pending appointments can be approved.']);
        }

        $appointment->status = 'approved';
        $appointment->save();

        // Optional: Notify the user about approval
        Notification::send($appointment->user, new AppointmentStatusChanged($appointment));

        return redirect()->route('admin.appointments.index')->with('success', 'Appointment approved successfully.');
    }

    /**
     * Deny the specified appointment.
     *
     * @param  \App\Models\Appointment  $appointment
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deny(Appointment $appointment)
    {
        if ($appointment->status !== 'pending') {
            return redirect()->back()->withErrors(['status' => 'Only pending appointments can be denied.']);
        }

        $appointment->status = 'denied';
        $appointment->save();

        // Optional: Notify the user about denial
        Notification::send($appointment->user, new AppointmentStatusChanged($appointment));

        return redirect()->route('admin.appointments.index')->with('success', 'Appointment denied successfully.');
    }
}
