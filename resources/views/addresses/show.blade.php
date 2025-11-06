@extends('layouts.app')

@section('content')
    <div class="container">
        <h2 class="mb-4">Address Details</h2>

        <table class="table table-bordered table-striped w-75 mx-auto">
            <tbody>
                <tr>
                    <th scope="row" style="width: 30%">Code</th>
                    <td>{{ $address->code }}</td>
                </tr>
                <tr>
                    <th scope="row">Region</th>
                    <td>{{ $address->region->name }}</td>
                </tr>
                <tr>
                    <th scope="row">Street</th>
                    <td>{{ $address->street }}</td>
                </tr>
                <tr>
                    <th scope="row">Road</th>
                    <td>{{ $address->road }}</td>
                </tr>
                <tr>
                    <th scope="row">Building</th>
                    <td>{{ $address->building }}</td>
                </tr>
                <tr>
                    <th scope="row">Block</th>
                    <td>{{ $address->block }}</td>
                </tr>
            </tbody>
        </table>

        <div class="text-center mt-4">
            <a href="{{ route('addresses.index') }}" class="btn btn-secondary">Back</a>
        </div>
    </div>
@endsection