@extends('layouts.app')

@section('content')
    <h2>Medicine Details</h2>
    <ul>
        <li><strong>Code:</strong> {{ $medicine->code }}</li>
        <li><strong>Name:</strong> {{ $medicine->name }}</li>
        <li><strong>Description:</strong> {{ $medicine->description }}</li>
        <li><strong>Quantity:</strong> {{ $medicine->quantity }}</li>
        <li><strong>Country:</strong> {{ $medicine->country->name ?? 'N/A' }}</li>
    </ul>
    <a href="{{ route('medicines.index') }}" class="btn btn-secondary">Back</a>
@endsection
