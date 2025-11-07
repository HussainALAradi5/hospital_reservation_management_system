@extends('layouts.app')

@section('content')
    <h2>All Rooms</h2>

    <form method="GET" action="{{ route('rooms.filter') }}" class="row g-2 mb-4">
        <div class="col-md-3">
            <select name="status" class="form-control">
                <option value="">— Filter by Status —</option>
                <option value="free">Free</option>
                <option value="occupied">Occupied</option>
                <option value="maintenance">Maintenance</option>
            </select>
        </div>
        <div class="col-md-3">
            <select name="type" class="form-control">
                <option value="">— Filter by Type —</option>
                <option value="doctor_season">Doctor Season</option>
                <option value="treatment">Treatment</option>
            </select>
        </div>
        <div class="col-md-3">
            <button type="submit" class="btn btn-primary">Filter</button>
        </div>
    </form>

    <a href="{{ route('rooms.create') }}" class="btn btn-success mb-3">Add Room</a>

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Code</th>
                <th>Name</th>
                <th>Type</th>
                <th>Status</th>
                <th>Hospital</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($rooms as $room)
                <tr>
                    <td>{{ $room->code }}</td>
                    <td>{{ $room->name }}</td>
                    <td>{{ ucfirst(str_replace('_', ' ', $room->type)) }}</td>
                    <td>{{ ucfirst($room->status) }}</td>
                    <td>{{ $room->hospital->name ?? '—' }}</td>
                    <td>
                        <a href="{{ route('rooms.edit', $room) }}" class="btn btn-sm btn-warning">Edit</a>
                        <a href="{{ route('rooms.show', $room) }}" class="btn btn-sm btn-info">View</a>
                        <form action="{{ route('rooms.destroy', $room) }}" method="POST" style="display:inline;">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger"
                                onclick="return confirm('Delete this room?')">Delete</button>
                        </form>
                        @if ($room->status === 'occupied' && $room->type === 'doctor_season')
                            <form method="POST" action="{{ route('rooms.release', $room) }}" style="display:inline;">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-outline-secondary">Release</button>
                            </form>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection