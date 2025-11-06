@extends('layouts.app')

@section('content')
    <div class="container">
        <h2 class="mb-4">Company Details</h2>

        <table class="table table-bordered table-striped w-75 mx-auto">
            <tbody>
                <tr>
                    <th scope="row" style="width: 30%">Name</th>
                    <td>{{ $medicineCompany->name }}</td>
                </tr>
                <tr>
                    <th scope="row">Code</th>
                    <td>{{ $medicineCompany->code }}</td>
                </tr>
        
                <tr>
                        <th scope="row">Country</th>
                        <td>
                            {{ $medicineCompany->country->name ?? 'N/A' }}
                            @if ($medicineCompany->country && $medicineCompany->country->flag_url)
                                <img src="{{ $medicineCompany->country->flag_url }}" alt="Flag" class="ms-2 img-thumbnail"                             style="max-width: 40px;">
                            @endif
                        </td>
                </tr>
                <tr>
                    <th scope="row">Address</th>
                    <td>{{ $medicineCompany->address->street ?? 'N/A' }}</td>
                </tr>
            </tbody>
        </table>

        <div class="text-center mt-4">
            <a href="{{ route('medicine_companies.index') }}" class="btn btn-secondary">Back</a>
        </div>
    </div>
@endsection