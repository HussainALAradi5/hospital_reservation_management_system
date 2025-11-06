@extends('layouts.app')

@section('content')
    <div class="container">
        <h2 class="mb-4">Country Details</h2>

        <table class="table table-bordered table-striped w-75 mx-auto">
            <tbody>
                <tr>
                    <th scope="row" style="width: 30%">Official Name</th>
                    <td>{{ $country->official_name }}</td>
                </tr>
                <tr>
                    <th scope="row">Name</th>
                    <td>{{ $country->name }}</td>
                </tr>
                <tr>
                    <th scope="row">Code</th>
                    <td>{{ $country->code }}</td>
                </tr>
                <tr>
                    <th scope="row">Flag</th>
                    <td>
                        @if ($country->flag_url)
                            <img src="{{ $country->flag_url }}" alt="Flag" class="img-thumbnail" style="max-width: 100px;">
                        @else
                            <em>No flag available</em>
                        @endif
                    </td>
                </tr>
            </tbody>
        </table>

        <div class="text-center mt-4">
            <a href="{{ route('countries.index') }}" class="btn btn-secondary">Back</a>
        </div>
    </div>
@endsection