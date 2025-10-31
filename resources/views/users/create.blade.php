@extends('layouts.app')

@section('content')
    <h2>Register Medical Staff</h2>

    <form method="POST" action="{{ route('users.store') }}">
        @csrf
        <div class="mb-3"><label>Name</label><input type="text" name="name" class="form-control" required></div>
        <div class="mb-3"><label>Email</label><input type="email" name="email" class="form-control" required></div>
        <div class="mb-3"><label>Password</label><input type="password" name="password" class="form-control" required>
        </div>
        <div class="mb-3"><label>Telephone</label><input type="text" name="telephone_number" class="form-control"
                required></div>
        <div class="mb-3"><label>Age</label><input type="number" name="age" class="form-control" required></div>
        <div class="mb-3">
            <label>Gender</label>
            <select name="gender_type" class="form-control" required>
                <option value="M">Male</option>
                <option value="F">Female</option>
            </select>
        </div>
        <div class="mb-3">
            <label>Married</label>
            <select name="is_married" class="form-control" required>
                <option value="1">Yes</option>
                <option value="0">No</option>
            </select>
        </div>
        <div class="mb-3">
            <label>User Type</label>
            <select name="user_type" class="form-control" required>
                <option value="doctor">Doctor</option>
                <option value="nurse">Nurse</option>
                <option value="pharmacist">Pharmacist</option>
                <option value="admin">Admin</option>
                <option value="patient">Patient</option>
            </select>
        </div>
        <div class="mb-3">
            <label>Hospital</label>
            <select name="hospital_id" class="form-control">
                <option value="">— Select Hospital —</option>
                @foreach ($hospitals as $hospital)
                    <option value="{{ $hospital->id }}">{{ $hospital->name }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-success">Register</button>
    </form>
@endsection
