@extends('layouts.app')

@section('content')
    

    <div class="text-center mb-4">
    <h2 class="mb-3">Hospitals</h2>
    <a href="{{ route('hospitals.create') }}" class="btn btn-primary">Add Hospital</a>
</div>


    @if ($hospitals->count())
        <div class="table-responsive">
            <table class="table table-bordered table-striped align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Code</th>
                        <th>Name</th>
                        <th>Region</th>
                        <th>Address</th>
                        <th>Open</th>
                        <th>Close</th>
                        <th>Days</th>
                        <th>Rooms</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($hospitals as $hospital)
                        <tr>
                            <td>{{ $hospital->code }}</td>
                            <td>{{ $hospital->name }}</td>
                            <td>{{ $hospital->region->name ?? '—' }}</td>
                            <td>{{ $hospital->address->code ?? '—' }}</td>
                            <td>{{ \Carbon\Carbon::parse($hospital->open_at)->format('H:i') }}</td>
                            <td>{{ \Carbon\Carbon::parse($hospital->close_at)->format('H:i') }}</td>
                            <td>{{ $hospital->days_of_work }}</td>
                            <td>
                                @if ($hospital->rooms->isEmpty())
                                    <span class="badge bg-secondary">None</span>
                                @else
                                    <div class="d-flex flex-wrap gap-1">
                                        @foreach ($hospital->rooms as $room)
                                            <a href="{{ route('rooms.show', $room) }}"
                                               class="badge bg-info text-dark text-decoration-none">
                                                {{ $room->code }}
                                            </a>
                                        @endforeach
                                    </div>
                                @endif
                            </td>
                            <td class="text-center">
                                <div class="d-flex justify-content-center gap-2">
                                    <a href="{{ route('hospitals.edit', $hospital) }}" class="btn btn-sm btn-warning">
                                        Edit
                                    </a>
                                    <form action="{{ route('hospitals.destroy', $hospital) }}" method="POST">
                                        @csrf @method('DELETE')
                                        <button class="btn btn-sm btn-danger"
                                                onclick="return confirm('Delete this hospital?')">
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div class="alert alert-info">No hospitals found.</div>
    @endif
@endsection