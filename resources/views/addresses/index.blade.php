@extends('layouts.app')

@section('content')
    <h2>Addresses</h2>
    <a href="{{ route('addresses.create') }}" class="btn btn-primary mb-3">Add Address</a>

    <table class="table">
        <thead>
            <tr>
                <th>Code</th>
                <th>Region</th>
                <th>Street</th>
                <th>Road</th>
                <th>Building</th>
                <th>Block</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($addresses as $address)
                <tr>
                    <td>{{ $address->code }}</td>
                    <td>{{ $address->region->name }}</td>
                    <td>{{ $address->street }}</td>
                    <td>{{ $address->road }}</td>
                    <td>{{ $address->building }}</td>
                    <td>{{ $address->block }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
