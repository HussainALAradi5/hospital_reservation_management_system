@extends('layouts.app')

@section('content')
    <h2>Room Details</h2>

    <table class="table table-bordered w-75 mx-auto">
        <tbody>
            <tr><th>Code</th><td>{{ $room->code }}</td></tr>
            <tr><th>Name</th><td>{{ $room->name }}</td></tr>
            <tr><th>Type</th><td>{{ ucfirst(str_replace('_', ' ', $room->type)) }}</td></tr>
            <tr><th>Status</th><td>{{ ucfirst($room->status) }}</td></tr>
            <tr><th>Hospital</th><td>{{ $room->hospital->name ?? '—' }}</td></tr>
        </tbody>
    </table>

    <h4 class="mt-4">Activity Logs</h4>
    <table class="table table-sm table-striped">
        <thead>
            <tr><th>Doctor ID</th><th>Action</th><th>Timestamp</th></tr>
        </thead>
        <tbody>
            @foreach ($room->last_sign_ins ?? [] as $entry)
                <tr>
                    <td>{{ $entry['user_id'] }}</td>
                    <td>Signed In</td>
                    <td>{{ $entry['timestamp'] }}</td>
                </tr>
            @endforeach
            @foreach ($room->sign_outs ?? [] as $entry)
                <tr>
                    <td>{{ $entry['user_id'] }}</td>
                    <td>Signed Out</td>
                    <td>{{ $entry['timestamp'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <a href="{{ route('rooms.index') }}" class="btn btn-secondary">Back</a>
@endsection