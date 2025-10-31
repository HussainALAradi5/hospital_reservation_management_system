@extends('layouts.app')

@section('content')
    <h2>Address Details</h2>

    <p><strong>Code:</strong> {{ $address->code }}</p>
    <p><strong>Region:</strong> {{ $address->region->name }}</p>
    <p><strong>Street:</strong> {{ $address->street }}</p>
    <p><strong>Road:</strong> {{ $address->road }}</p>
    <p><strong>Building:</strong> {{ $address->building }}</p>
    <p><strong>Block:</strong> {{ $address->block }}</p>
@endsection
