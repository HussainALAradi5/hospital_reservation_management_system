@extends('layouts.app')

@section('content')
    <h2 class="mb-4">Medicine Descriptions</h2>

    @if (in_array(auth()->user()->user_type, ['doctor', 'admin']))
        <div class="mb-3 text-center">
            <a href="{{ route('medicine_descriptions.create') }}" class="btn btn-primary">Add Description</a>
        </div>
    @endif

    <table class="table table-bordered table-striped">
        <thead class="table-light">
            <tr>
                <th>Code</th>
                <th>Name</th>
                <th>Medicine</th>
                <th>Doctor</th>
                @if (auth()->user()->user_type !== 'patient')
                    <th>Patient</th>
                @endif
                <th>Quantity</th>
                <th>Days</th>
                <th>Hospital</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($descriptions as $desc)
                <tr>
                    <td>{{ $desc->code }}</td>
                    <td>{{ $desc->name }}</td>
                    <td>{{ $desc->medicine->name ?? '—' }}</td>
                    <td>{{ $desc->doctor->name ?? '—' }}</td>
                    @if (auth()->user()->user_type !== 'patient')
                        <td>{{ $desc->patient->name ?? '—' }}</td>
                    @endif
                    <td>{{ $desc->quantity }}</td>
                    <td>{{ $desc->number_of_days }}</td>
                    <td>{{ $desc->hospital->name ?? '—' }}</td>
                    <td>
                        <a href="{{ route('medicine_descriptions.show', $desc) }}" class="btn btn-sm btn-info">View</a>
                        @if (in_array(auth()->user()->user_type, ['doctor', 'admin']))
                            <a href="{{ route('medicine_descriptions.edit', $desc) }}" class="btn btn-sm btn-warning">Edit</a>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection