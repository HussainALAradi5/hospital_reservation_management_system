@extends('layouts.app')

@section('content')
    <h2>Add Address</h2>

    <form method="POST" action="{{ route('addresses.store') }}">
        @csrf
        <div class="mb-3">
            <label>Code</label>
            <input type="text" name="code" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Region</label>
            <select name="region_id" class="form-control" required>
                @foreach ($regions as $region)
                    <option value="{{ $region->id }}">{{ $region->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label>Street</label>
            <input type="text" name="street" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Road</label>
            <input type="text" name="road" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Building</label>
            <input type="text" name="building" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Block</label>
            <input type="text" name="block" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success">Save</button>
    </form>
@endsection
