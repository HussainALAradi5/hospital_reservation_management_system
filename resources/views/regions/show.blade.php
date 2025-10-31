@extends('layouts.app')

@section('content')
    <h2>Region Details</h2>

    <p><strong>Name:</strong> {{ $region->name }}</p>
    <p><strong>Code:</strong> {{ $region->code }}</p>
@endsection
