@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Countries</h2>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @elseif(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <a href="{{ route('countries.create') }}" class="btn btn-primary mb-3">Add Country</a>
        <a href="{{ route('countries.sync') }}" class="btn btn-warning mb-3">Sync from API</a>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Official Name</th>
                    <th>Common Name</th>
                    <th>Code</th>
                    <th>Flag</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($countries as $country)
                    <tr>
                        <td>{{ $country->official_name }}</td>
                        <td>
                            @if ($country->flag_url)
                                <img src="{{ $country->flag_url }}" alt="Flag" width="20" class="me-1">
                            @endif
                            {{ $country->name }}
                        </td>
                        <td>{{ $country->code }}</td>
                        <td>
                            @if ($country->flag_url)
                                <img src="{{ $country->flag_url }}" alt="Flag" width="40">
                            @else
                                <em>No flag</em>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('countries.show', $country) }}" class="btn btn-info btn-sm">View</a>
                            <a href="{{ route('countries.edit', $country) }}" class="btn btn-secondary btn-sm">Edit</a>
                            <form action="{{ route('countries.destroy', $country) }}" method="POST"
                                style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm"
                                    onclick="return confirm('Delete this country?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
