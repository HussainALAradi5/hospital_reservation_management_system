@extends('layouts.app')

@section('content')
    <h2 class="mb-4">Appointment Details</h2>

    <div class="card">
        <div class="card-body">
            <p><strong>Code:</strong> {{ $appointment->code }}</p>
            <p><strong>Date:</strong> {{ $appointment->appointment_date }}</p>
            <p><strong>Time:</strong> {{ $appointment->appointment_time }}</p>
            <p><strong>Status:</strong> {{ ucfirst($appointment->status) }}</p>
            <p><strong>Doctor:</strong> {{ $appointment->doctor->name }}</p>
            <p><strong>Patient:</strong> {{ $appointment->patient->name }}</p>
            <p><strong>Hospital:</strong> {{ $appointment->hospital->name }}</p>
            <p><strong>Room:</strong> {{ $appointment->room->name }}</p>
        </div>
    </div>
@endsection