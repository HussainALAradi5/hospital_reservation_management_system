@extends('layouts.app')

@section('content')
    <h2>Edit Address</h2>

    <form method="POST" action="{{ route('addresses.update', $address) }}">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label>Code</label>
            <input type="text" name="code" class="form-control" value="{{ $address->code }}" required>
        </div>
        <div class="mb-3">
            <label>Region</label>
            <select name="region_id" class="form-control" required>
                @foreach ($regions as $region)
                    <option value="{{ $region->id }}" {{ $region->id === $address->region_id ? 'selected' : '' }}>
                        {{ $region->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label>Street</label>
            <input type="text" name="street" class="form-control" value="{{ $address->street }}" required>
        </div>
        <div class="mb-3">
            <label>Road</label>
            <input type="text" name="road" class="form-control" value="{{ $address->road }}" required>
        </div>
        <div class="mb-3">
            <label>Building</label>
            <input type="text" name="building" class="form-control" value="{{ $address->building }}" required>
        </div>
        <div class="mb-3">
            <label>Block</label>
            <input type="text" name="block" class="form-control" value="{{ $address->block }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
@endsection
