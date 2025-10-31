@extends('layouts.app')

@section('content')
    <h2>All Rooms</h2>
    <a href="{{ route('rooms.create') }}" class="btn btn-primary mb-3">Add Room</a>

    <table class="table">
        <thead>
            <tr>
                <th>Code</th>
                <th>Type</th>
                <th>Capacity</th>
                <th>Status</th>
                <th>Hospital</th>
                <th>Occupied By</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($rooms as $room)
                <tr>
                    <td>{{ $room->code }}</td>
                    <td>{{ ucfirst(str_replace('_', ' ', $room->type)) }}</td>
                    <td>{{ $room->capacity }}</td>
                    <td>{{ ucfirst($room->status) }}</td>
                    <td>{{ $room->hospital->name ?? '—' }}</td>
                    <td>{{ $room->medicalStaff->name ?? '—' }}</td>
                    <td>
                        <a href="{{ route('rooms.edit', $room) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('rooms.destroy', $room) }}" method="POST" style="display:inline;">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger"
                                onclick="return confirm('Delete this room?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
