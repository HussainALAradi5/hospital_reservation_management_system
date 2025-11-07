@extends('layouts.app')

@section('content')
    <h2 class="mb-4">Medicine Description Details</h2>

    <table class="table table-bordered w-75 mx-auto">
        <tbody>
            <tr><th>Code</th><td>{{ $medicineDescription->code }}</td></tr>
            <tr><th>Name</th><td>{{ $medicineDescription->name }}</td></tr>
            <tr><th>Description</th><td>{{ $medicineDescription->description }}</td></tr>
            <tr><th>Quantity</th><td>{{ $medicineDescription->quantity }}</td></tr>
            <tr><th>Number of Days</th><td>{{ $medicineDescription->number_of_days }}</td></tr>
            <tr><th>Medicine</th><td>{{ $medicineDescription->medicine->name ?? '—' }}</td></tr>
            <tr><th>Doctor</th><td>{{ $medicineDescription->doctor->name ?? '—' }}</td></tr>
            @if (auth()->user()->user_type !== 'patient')
                <tr><th>Patient</th><td>{{ $medicineDescription->patient->name ?? '—' }}</td></tr>
            @endif
            <tr><th>Hospital</th><td>{{ $medicineDescription->hospital->name ?? '—' }}</td></tr>
        </tbody>
    </table>

    <div class="text-center mt-4">
        <a href="{{ route('medicine_descriptions.index') }}" class="btn btn-secondary">Back</a>
        @if (in_array(auth()->user()->user_type, ['doctor', 'admin']))
            <a href="{{ route('medicine_descriptions.edit', $medicineDescription) }}" class="btn btn-warning">Edit</a>
        @endif
    </div>
@endsection