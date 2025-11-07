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
            <label>Name</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Type</label>
            <select name="type" class="form-control" required>
                <option value="doctor_season">Doctor Season</option>
                <option value="treatment">Treatment</option>
            </select>
        </div>

        <div class="mb-3">
            <label>Status</label>
            <select name="status" class="form-control">
                <option value="free">Free</option>
                <option value="occupied">Occupied</option>
                <option value="maintenance">Maintenance</option>
            </select>
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
            <label>Medical Staff</label>
            <select name="medical_staff_ids[]" class="form-control" multiple>
                @foreach ($staff as $user)
                    <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->user_type }})</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-success">Save Room</button>
    </form>
@endsection