@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Country Details</h2>

        <div class="mb-3">
            <strong>Official Name:</strong> {{ $country->official_name }}
        </div>

        <div class="mb-3">
            <strong>Name:</strong> {{ $country->name }}
        </div>

        <div class="mb-3">
            <strong>Code:</strong> {{ $country->code }}
        </div>

        <div class="mb-3">
            <strong>Flag:</strong><br>
            @if ($country->flag_url)
                <img src="{{ $country->flag_url }}" alt="Flag" width="80">
            @else
                <em>No flag available</em>
            @endif
        </div>

        <a href="{{ route('countries.index') }}" class="btn btn-secondary">Back</a>
    </div>
@endsection
