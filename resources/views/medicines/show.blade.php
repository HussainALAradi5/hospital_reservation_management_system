@extends('layouts.app')

@section('content')
    <div class="container">
        <h2 class="mb-4">Medicine Details</h2>

        <table class="table table-bordered table-striped w-75 mx-auto">
            <tbody>
                <tr>
                    <th scope="row" style="width: 30%">Code</th>
                    <td>{{ $medicine->code }}</td>
                </tr>
                <tr>
                    <th scope="row">Name</th>
                    <td>{{ $medicine->name }}</td>
                </tr>
                <tr>
                    <th scope="row">Description</th>
                    <td>{{ $medicine->description }}</td>
                </tr>
                <tr>
                    <th scope="row">Quantity</th>
                    <td>{{ $medicine->quantity }}</td>
                </tr>
           
                <tr>
                           <th scope="row">Country</th>
                           <td>
                               {{ $medicine->country->name ?? 'N/A' }}
                               @if ($medicine->country && $medicine->country->flag_url)
                                   <img src="{{ $medicine->country->flag_url }}" alt="Flag" class="ms-2 img-thumbnail"                      style="max-width: 40px;">
                               @endif
                           </td>
                </tr>
                <tr>
                    <th scope="row">Company</th>
                    <td>{{ $medicine->company->name ?? 'N/A' }}</td>
                </tr>
            </tbody>
        </table>

        <div class="text-center mt-4">
            <a href="{{ route('medicines.index') }}" class="btn btn-secondary">Back</a>
        </div>
    </div>
@endsection