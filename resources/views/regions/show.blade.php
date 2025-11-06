@extends('layouts.app')

@section('content')
    <div class="container">
        <h2 class="mb-4">Region Details</h2>

        <table class="table table-bordered table-striped w-75 mx-auto">
            <tbody>
                <tr>
                    <th scope="row" style="width: 30%">Name</th>
                    <td>{{ $region->name }}</td>
                </tr>
                <tr>
                    <th scope="row">Code</th>
                    <td>{{ $region->code }}</td>
                </tr>
            </tbody>
        </table>

        <div class="text-center mt-4">
            <a href="{{ route('regions.index') }}" class="btn btn-secondary">Back</a>
        </div>
    </div>
@endsection