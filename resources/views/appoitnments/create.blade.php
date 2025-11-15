@extends('layouts.app')

@section('content')
    <h2 class="mb-4">Create Appointment</h2>

    <form method="POST" action="{{ route('appointments.store') }}" class="row g-3">
        @csrf

        <div class="col-md-6">
            <label class="form-label">Code</label>
            <input type="text" name="code" class="form-control" required>
        </div>

        <div class="col-md-6">
            <label class="form-label">Date</label>
            <input type="date" name="appointment_date" class="form-control" required>
        </div>

        <div class="col-md-6">
            <label class="form-label">Time</label>
            <input type="time" name="appointment_time" class="form-control" required>
        </div>

        <div class="col-md-6">
            <label class="form-label">Status</label>
            <select name="status" class="form-select" required>
                <option value="pending">Pending</option>
                <option value="arrived">Arrived</option>
                <option value="done">Done</option>
                <option value="absent">Absent</option>
            </select>
        </div>

        <div class="col-md-6">
            <label class="form-label">Doctor</label>
            <select name="doctor_id" class="form-select" required>
                @foreach ($doctors as $doc)
                    <option value="{{ $doc->id }}">{{ $doc->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="col-md-6">
            <label class="form-label">Patient</label>
            <select name="patient_id" class="form-select" required>
                @foreach ($patients as $pat)
                    <option value="{{ $pat->id }}">{{ $pat->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="col-md-6">
            <label class="form-label">Hospital</label>
            <select name="hospital_id" class="form-select" required>
                @foreach ($hospitals as $hospital)
                    <option value="{{ $hospital->id }}">{{ $hospital->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="col-md-6">
            <label class="form-label">Room</label>
            <select name="room_id" class="form-select" required>
                @foreach ($rooms as $room)
                    <option value="{{ $room->id }}">{{ $room->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="col-12 text-center">
            <button class="btn btn-success">Create Appointment</button>
        </div>
    </form>
@endsection