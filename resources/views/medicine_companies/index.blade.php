@extends('layouts.app')

@section('content')
    <h2>Medicine Companies</h2>
    <a href="{{ route('medicine_companies.create') }}" class="btn btn-primary mb-3">Add Company</a>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Code</th>
                <th>Country</th>
                <th>Address</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($companies as $company)
                <tr>
                    <td>{{ $company->name }}</td>
                    <td>{{ $company->code }}</td>
                    <td>
                   
                       @if ($company->country && $company->country->flag_url)
                           <img src="{{ $company->country->flag_url }}" alt="Flag" class="ms-2 img-thumbnail"               style="max-width: 30px;">
                       @endif
                           {{ $company->country->name ?? 'N/A' }}
                    </td>
                    <td>{{ $company->address->street ?? 'N/A' }}</td>
                    <td>
                        <a href="{{ route('medicine_companies.show', $company) }}" class="btn btn-info btn-sm">View</a>
                        <a href="{{ route('medicine_companies.edit', $company) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('medicine_companies.destroy', $company) }}" method="POST" style="display:inline-block;">
                            @csrf @method('DELETE')
                            <button class="btn btn-danger btn-sm" onclick="return confirm('Delete this company?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection