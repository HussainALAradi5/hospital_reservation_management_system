@extends('layouts.app')

@section('content')
    <h2>Regions</h2>
    <a href="{{ route('regions.create') }}" class="btn btn-primary mb-3">Add Region</a>

    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Code</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($regions as $region)
                <tr>
                    <td>{{ $region->name }}</td>
                    <td>{{ $region->code }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
