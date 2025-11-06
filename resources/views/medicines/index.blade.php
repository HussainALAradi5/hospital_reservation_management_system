@extends('layouts.app')

@section('content')
    <h2>Medicines</h2>
    <a href="{{ route('medicines.create') }}" class="btn btn-primary mb-3">Add Medicine</a>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>Code</th>
                <th>Name</th>
                <th>Description</th>
                <th>Quantity</th>
                <th>Produce Country</th>
                <th>Actions</th>
                <th>Company</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($medicines as $medicine)
                <tr>
                    <td>{{ $medicine->code }}</td>
                    <td>{{ $medicine->name }}</td>
                    <td>{{ $medicine->description }}</td>
                    <td>{{ $medicine->quantity }}</td>
                    <td>{{ $medicine->country->name ?? 'N/A' }}</td>
                    <td>{{ $medicine->company->name ?? 'N/A' }}</td>
                    <td>
                        <a href="{{ route('medicines.show', $medicine) }}" class="btn btn-info btn-sm">View</a>
                        <a href="{{ route('medicines.edit', $medicine) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('medicines.destroy', $medicine) }}" method="POST"
                            style="display:inline-block;">
                            @csrf @method('DELETE')
                            <button class="btn btn-danger btn-sm"
                                onclick="return confirm('Delete this medicine?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
