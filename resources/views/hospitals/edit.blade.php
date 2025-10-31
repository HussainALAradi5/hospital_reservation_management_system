@extends('layouts.app')

@section('content')
    <h2>Edit Hospital</h2>

    <form method="POST" action="{{ route('hospitals.update', $hospital) }}">
        @csrf @method('PUT')
        <div class="mb-3">
            <label>Code</label>
            <input type="text" name="code" class="form-control" value="{{ $hospital->code }}" required>
        </div>
        <div class="mb-3">
            <label>Name</label>
            <input type="text" name="name" class="form-control" value="{{ $hospital->name }}" required>
        </div>
        <div class="mb-3">
            <label>Region</label>
            <select name="region_id" class="form-control" required>
                @foreach ($regions as $region)
                    <option value="{{ $region->id }}" {{ $region->id === $hospital->region_id ? 'selected' : '' }}>
                        {{ $region->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label>Address</label>
            <select name="address_id" class="form-control" required>
                @foreach ($addresses as $address)
                    <option value="{{ $address->id }}" {{ $address->id === $hospital->address_id ? 'selected' : '' }}>
                        {{ $address->code }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label>Open At</label>
            <input type="time" name="open_at" class="form-control" value="{{ $hospital->open_at }}" required>
        </div>
        <div class="mb-3">
            <label>Close At</label>
            <input type="time" name="close_at" class="form-control" value="{{ $hospital->close_at }}" required>
        </div>
        <div class="mb-3">
            <label>Days of Work</label>
            <input type="text" name="days_of_work" class="form-control" value="{{ $hospital->days_of_work }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
@endsection
