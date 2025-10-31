@extends('layouts.app')

@section('content')
    <h2>Edit Region</h2>

    <form method="POST" action="{{ route('regions.update', $region) }}">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label>Name</label>
            <input type="text" name="name" class="form-control" value="{{ $region->name }}" required>
        </div>
        <div class="mb-3">
            <label>Code</label>
            <input type="text" name="code" class="form-control" value="{{ $region->code }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
@endsection
