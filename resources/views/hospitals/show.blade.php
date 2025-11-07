@extends('layouts.app')

@section('content')
    <h2>Hospital Details</h2>

    <table class="table table-bordered w-75 mx-auto">
        <tbody>
            <tr><th>Name</th><td>{{ $hospital->name }}</td></tr>
            <tr><th>Address</th><td>{{ $hospital->address->full ?? '—' }}</td></tr>
            <tr><th>Region</th><td>{{ $hospital->region->name ?? '—' }}</td></tr>
        </tbody>
    </table>

    <h4 class="mt-4">Assigned Rooms</h4>
    @if ($hospital->rooms->isEmpty())
        <p class="text-muted">No rooms assigned to this hospital.</p>
    @else
        <table class="table table-sm table-striped">
            <thead>
                <tr><th>ID</th><th>Code</th><th>Name</th><th>Type</th><th>Status</th></tr>
            </thead>
            <tbody>
                @foreach ($hospital->rooms as $room)
                    <tr>
                        <td>{{ $room->id }}</td>
                        <td>{{ $room->code }}</td>
                        <td>{{ $room->name }}</td>
                        <td>{{ ucfirst(str_replace('_', ' ', $room->type)) }}</td>
                        <td>{{ ucfirst($room->status) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    <a href="{{ route('hospitals.index') }}" class="btn btn-secondary">Back</a>
@endsection