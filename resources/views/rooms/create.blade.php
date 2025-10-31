@extends('layouts.app')

@section('content')
    <h2>Create Room</h2>

    <form method="POST" action="{{ route('rooms.store') }}">
        @csrf

        <div class="mb-3">
            <label>Code</label>
            <input type="text" name="code" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Type</label>
            <select name="type" class="form-control" required>
                <option value="doctor_season">Doctor Season</option>
                <option value="treatment">Treatment</option>
            </select>
        </div>

        <div class="mb-3">
            <label>Capacity</label>
            <input type="number" name="capacity" class="form-control" required min="1">
        </div>

        <div class="mb-3">
            <label>Hospital</label>
            <select name="hospital_id" class="form-control" required>
                @foreach ($hospitals as $hospital)
                    <option value="{{ $hospital->id }}">{{ $hospital->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Status</label>
            <select name="status" class="form-control" required>
                <option value="free">Free</option>
                <option value="occupied">Occupied</option>
                <option value="maintenance">Maintenance</option>
            </select>
        </div>

        <div class="mb-3">
            <label>Medical Staff (only if occupied)</label>
            <select name="medical_staff_id" class="form-control">
                <option value="">— Select Staff —</option>
                @foreach ($staff as $user)
                    <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->user_type }})</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-success">Save Room</button>
    </form>
@endsection
