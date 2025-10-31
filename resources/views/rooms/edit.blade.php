@extends('layouts.app')

@section('content')
    <h2>Edit Room</h2>

    <form method="POST" action="{{ route('rooms.update', $room) }}">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Code</label>
            <input type="text" name="code" class="form-control" value="{{ $room->code }}" required>
        </div>

        <div class="mb-3">
            <label>Type</label>
            <select name="type" class="form-control" required>
                <option value="doctor_season" {{ $room->type === 'doctor_season' ? 'selected' : '' }}>Doctor Season</option>
                <option value="treatment" {{ $room->type === 'treatment' ? 'selected' : '' }}>Treatment</option>
            </select>
        </div>

        <div class="mb-3">
            <label>Capacity</label>
            <input type="number" name="capacity" class="form-control" value="{{ $room->capacity }}" required
                min="1">
        </div>

        <div class="mb-3">
            <label>Hospital</label>
            <select name="hospital_id" class="form-control" required>
                @foreach ($hospitals as $hospital)
                    <option value="{{ $hospital->id }}" {{ $room->hospital_id === $hospital->id ? 'selected' : '' }}>
                        {{ $hospital->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Status</label>
            <select name="status" class="form-control" required>
                <option value="free" {{ $room->status === 'free' ? 'selected' : '' }}>Free</option>
                <option value="occupied" {{ $room->status === 'occupied' ? 'selected' : '' }}>Occupied</option>
                <option value="maintenance" {{ $room->status === 'maintenance' ? 'selected' : '' }}>Maintenance</option>
            </select>
        </div>

        <div class="mb-3">
            <label>Medical Staff (only if occupied)</label>
            <select name="medical_staff_id" class="form-control">
                <option value="">— Select Staff —</option>
                @foreach ($staff as $user)
                    <option value="{{ $user->id }}" {{ $room->medical_staff_id === $user->id ? 'selected' : '' }}>
                        {{ $user->name }} ({{ $user->user_type }})
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-success">Update Room</button>
    </form>
@endsection
