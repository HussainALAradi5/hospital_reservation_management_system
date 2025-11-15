@extends('layouts.app')

@section('content')
    <h2 class="mb-4">Edit Appointment</h2>

    <form method="POST" action="{{ route('appointments.update', $appointment) }}" class="row g-3">
        @csrf @method('PUT')

        <div class="col-md-6">
            <label class="form-label">Date</label>
            <input type="date" name="appointment_date" class="form-control" value="{{ $appointment->appointment_date }}" required>
        </div>

        <div class="col-md-6">
            <label class="form-label">Time</label>
            <input type="time" name="appointment_time" class="form-control" value="{{ $appointment->appointment_time }}" required>
        </div>

        <div class="col-md-6">
            <label class="form-label">Status</label>
            <select name="status" class="form-select" required>
                <option value="pending" @selected($appointment->status === 'pending')>Pending</option>
                <option value="arrived" @selected($appointment->status === 'arrived')>Arrived</option>
                <option value="done" @selected($appointment->status === 'done')>Done</option>
                <option value="absent" @selected($appointment->status === 'absent')>Absent</option>
            </select>
        </div>

        <div class="col-md-6">
            <label class="form-label">Doctor</label>
            <select name="doctor_id" class="form-select" required>
                @foreach ($doctors as $doc)
                    <option value="{{ $doc->id }}" @selected($doc->id == $appointment->doctor_id)>{{ $doc->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="col-md-6">
            <label class="form-label">Patient</label>
            <select name="patient_id" class="form-select" required>
                @foreach ($patients as $pat)
                    <option value="{{ $pat->id }}" @selected($pat->id == $appointment->patient_id)>{{ $pat->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="col-md-6">
            <label class="form-label">Hospital</label>
            <select name="hospital_id" class="form-select" required>
                @foreach ($hospitals as $hospital)
                    <option value="{{ $hospital->id }}" @selected($hospital->id == $appointment->hospital_id)>{{ $hospital->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="col-md-6">
            <label class="form-label">Room</label>
            <select name="room_id" class="form-select" required>
                @foreach ($rooms as $room)
                    <option value="{{ $room->id }}" @selected($room->id == $appointment->room_id)>{{ $room->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="col-12 text-center">
            <button class="btn btn-success">Update Appointment</button>
        </div>
    </form>
@endsection