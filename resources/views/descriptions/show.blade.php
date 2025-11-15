@extends('layouts.app')

@section('content')
    <h2 class="mb-4">Description Details</h2>

    <div class="card">
        <div class="card-body">
            <p><strong>Code:</strong> {{ $description->code }}</p>
            <p><strong>Name:</strong> {{ $description->name }}</p>
            <p><strong>Description:</strong> {{ $description->description ?? '—' }}</p>
            <p><strong>Status:</strong> {{ ucfirst(str_replace('_', ' ', $description->status)) }}</p>
            <p><strong>Date Written:</strong> {{ $description->date_written ?? '—' }}</p>
            <p><strong>Doctor:</strong> {{ $description->doctor->name ?? '—' }}</p>
            <p><strong>Patient:</strong> {{ $description->patient->name ?? '—' }}</p>
            <p><strong>Hospital:</strong> {{ $description->hospital->name ?? '—' }}</p>

            @if ($description->description_type === 'medicine')
                <hr>
                <p><strong>Medicine:</strong> {{ $description->medicine->name ?? '—' }}</p>
                <p><strong>Quantity:</strong> {{ $description->quantity }}</p>
                <p><strong>Number of Days:</strong> {{ $description->number_of_days }}</p>
            @endif
        </div>
    </div>
@endsection