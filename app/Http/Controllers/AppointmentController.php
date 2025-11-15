<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Hospital;
use App\Models\Room;
use App\Models\User;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public function index()
    {
        $appointments = Appointment::with(['doctor', 'patient', 'hospital', 'room'])->get();
        return view('appointments.index', compact('appointments'));
    }

    public function create()
    {
        $hospitals = Hospital::all();
        $rooms = Room::all();
        $doctors = User::where('user_type', 'doctor')->get();
        $patients = User::where('user_type', 'patient')->get();

        return view('appointments.create', compact('hospitals', 'rooms', 'doctors', 'patients'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|unique:appointments',
            'hospital_id' => 'required|exists:hospitals,id',
            'room_id' => 'required|exists:rooms,id',
            'doctor_id' => 'required|exists:users,id',
            'patient_id' => 'required|exists:users,id',
            'appointment_date' => 'required|date',
            'appointment_time' => 'required|date_format:H:i',
            'status' => 'required|in:pending,arrived,done,absent',
        ]);

        Appointment::create($request->all());

        return redirect()->route('appointments.index')->with('success', 'Appointment created.');
    }

    public function show(Appointment $appointment)
    {
        $appointment->load(['doctor', 'patient', 'hospital', 'room']);
        return view('appointments.show', compact('appointment'));
    }

    public function edit(Appointment $appointment)
    {
        $hospitals = Hospital::all();
        $rooms = Room::all();
        $doctors = User::where('user_type', 'doctor')->get();
        $patients = User::where('user_type', 'patient')->get();

        return view('appointments.edit', compact('appointment', 'hospitals', 'rooms', 'doctors', 'patients'));
    }

    public function update(Request $request, Appointment $appointment)
    {
        $request->validate([
            'hospital_id' => 'required|exists:hospitals,id',
            'room_id' => 'required|exists:rooms,id',
            'doctor_id' => 'required|exists:users,id',
            'patient_id' => 'required|exists:users,id',
            'appointment_date' => 'required|date',
            'appointment_time' => 'required|date_format:H:i',
            'status' => 'required|in:pending,arrived,done,absent',
        ]);

        $appointment->update($request->all());

        return redirect()->route('appointments.index')->with('success', 'Appointment updated.');
    }

    public function doctorAppointments()
    {
        $appointments = Appointment::with(['patient', 'hospital', 'room'])
            ->where('doctor_id', auth()->id())
            ->orderBy('appointment_date')
            ->orderBy('appointment_time')
            ->get();

        return view('appointments.doctor', compact('appointments'));
    }

    public function myAppointments()
    {
        $appointments = Appointment::with(['doctor', 'hospital', 'room'])
            ->where('patient_id', auth()->id())
            ->orderBy('appointment_date')
            ->orderBy('appointment_time')
            ->get();

        return view('appointments.my', compact('appointments'));
    }
}