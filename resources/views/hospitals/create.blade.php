@extends('layouts.app')

@section('content')
    <h2>Add Hospital</h2>

    <form method="POST" action="{{ route('hospitals.store') }}">
        @csrf

        <div class="mb-3">
            <label>Code</label>
            <input type="text" name="code" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Name</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Region</label>
            <select name="region_id" class="form-control">
                <option value="">— Select Region —</option>
                @foreach ($regions as $region)
                    <option value="{{ $region->id }}" {{ $region->id == $selected_region ? 'selected' : '' }}>
                        {{ $region->name }}
                    </option>
                @endforeach
            </select>
            <a href="{{ route('regions.create') }}" class="btn btn-sm btn-outline-secondary mt-2">
                ➕ Create New Region
            </a>
        </div>

        <div class="mb-3">
            <label>Address</label>
            <select name="address_id" class="form-control">
                <option value="">— Select Address —</option>
                @foreach ($addresses as $address)
                    <option value="{{ $address->id }}" {{ $address->id == $selected_address ? 'selected' : '' }}>
                        {{ $address->code }}
                    </option>
                @endforeach
            </select>
            <a href="{{ route('addresses.create') }}" class="btn btn-sm btn-outline-secondary mt-2">
                ➕ Create New Address
            </a>
        </div>

        <div class="mb-3">
            <label>Open At</label>
            <input type="time" name="open_at" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Close At</label>
            <input type="time" name="close_at" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Days of Work</label>
            <input type="text" name="days_of_work" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-success">Save Hospital</button>
    </form>
@endsection
