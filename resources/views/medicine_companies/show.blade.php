@extends('layouts.app')

@section('content')
    <h2>Company Details</h2>
    <ul>
        <li><strong>Name:</strong> {{ $medicineCompany->name }}</li>
        <li><strong>Code:</strong> {{ $medicineCompany->code }}</li>
        <li><strong>Country:</strong> {{ $medicineCompany->country->name ?? 'N/A' }}</li>
        <li><strong>Address:</strong> {{ $medicineCompany->address->street ?? 'N/A' }}</li>
    </ul>
    <a href="{{ route('medicine_companies.index') }}" class="btn btn-secondary">Back</a>
@endsection