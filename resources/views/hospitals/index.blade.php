@extends('layouts.app')

@section('content')
    <h2>Hospitals</h2>
    <a href="{{ route('hospitals.create') }}" class="btn btn-primary mb-3">Add Hospital</a>

    @if ($hospitals->count())
        <table class="table">
            <thead>
                <tr>
                    <th>Code</th>
                    <th>Name</th>
                    <th>Region</th>
                    <th>Address</th>
                    <th>Open</th>
                    <th>Close</th>
                    <th>Days</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($hospitals as $hospital)
                    <tr>
                        <td>{{ $hospital->code }}</td>
                        <td>{{ $hospital->name }}</td>
                        <td>{{ $hospital->region->name ?? '—' }}</td>
                        <td>{{ $hospital->address->code ?? '—' }}</td>
                        <td>{{ $hospital->open_at }}</td>
                        <td>{{ $hospital->close_at }}</td>
                        <td>{{ $hospital->days_of_work }}</td>
                        <td>
                            <a href="{{ route('hospitals.edit', $hospital) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('hospitals.destroy', $hospital) }}" method="POST" style="display:inline;">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-danger"
                                    onclick="return confirm('Delete this hospital?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>No hospitals found.</p>
    @endif
@endsection
