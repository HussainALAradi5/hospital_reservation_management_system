@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Add Country</h2>

        <form method="POST" action="{{ route('countries.store') }}">
            @csrf

            <div class="mb-3">
                <label>Offical Name</label>
                <input type="text" name="official_name" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Name</label>
                <input type="text" name="name" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Code (2-letter)</label>
                <input type="text" name="code" class="form-control" maxlength="2" required>
            </div>

            <div class="mb-3">
                <label>Flag URL</label>
                <input type="url" name="flag_url" class="form-control">
            </div>

            <button type="submit" class="btn btn-success">Save</button>
            <a href="{{ route('countries.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
@endsection
