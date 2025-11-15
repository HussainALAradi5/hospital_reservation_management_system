@extends('layouts.app')

@section('content')
    <h2 class="mb-4">All Appointments</h2>

    <table class="table table-bordered table-striped">
        <thead class="table-light">
            <tr>
                <th>Code</th>
                <th>Doctor</th>
                <th>Patient</th>
                <th>Date</th>
                <th>Time</th>
                <th>Status</th>
                <th>Hospital</th>
                <th>Room</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($appointments as $appt)
                <tr>
                    <td>{{ $appt->code }}</td>
                    <td>{{ $appt->doctor->name }}</td>
                    <td>{{ $appt->patient->name }}</td>
                    <td>{{ $appt->appointment_date }}</td>
                    <td>{{ $appt->appointment_time }}</td>
                    <td>{{ ucfirst($appt->status) }}</td>
                    <td>{{ $appt->hospital->name }}</td>
                    <td>{{ $appt->room->name }}</td>
                    <td>
                        <a href="{{ route('appointments.show', $appt) }}" class="btn btn-sm btn-info">View</a>
                        <a href="{{ route('appointments.edit', $appt) }}" class="btn btn-sm btn-warning">Edit</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection