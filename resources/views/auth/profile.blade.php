@extends('layouts.app')

@section('content')
    <h3>Your Profile</h3>
    <ul class="list-group">
        <li class="list-group-item"><strong>Name:</strong> {{ $user->name }}</li>
        <li class="list-group-item"><strong>Email:</strong> {{ $user->email }}</li>
        <li class="list-group-item"><strong>Telephone:</strong> {{ $user->telephone_number ?? 'N/A' }}</li>
        <li class="list-group-item"><strong>Age:</strong> {{ $user->age }}</li>
        <li class="list-group-item"><strong>Gender:</strong> {{ $user->gender_type == 'M' ? 'Male' : 'Female' }}</li>
        <li class="list-group-item"><strong>Marital Status:</strong> {{ $user->is_married ? 'Married' : 'Single' }}</li>
        <li class="list-group-item"><strong>User Type:</strong> {{ ucfirst($user->user_type) }}</li>
    </ul>
@endsection
