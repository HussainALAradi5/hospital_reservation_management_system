@extends('layouts.app')

@section('content')
    <h2>All Users</h2>
    <a href="{{ route('users.create') }}" class="btn btn-primary mb-3">Register New User</a>

    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>User Type</th>
                <th>Hospital</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->user_type }}</td>
                    <td>{{ $user->hospital->name ?? '—' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
