@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Edit Country</h2>

        <form method="POST" action="{{ route('countries.update', $country) }}">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label>Name</label>
                <input type="text" name="name" class="form-control" value="{{ $country->name }}" required>
            </div>

            <div class="mb-3">
                <label>Code (2-letter)</label>
                <input type="text" name="code" class="form-control" value="{{ $country->code }}" maxlength="2"
                    required>
            </div>

            <div class="mb-3">
                <label>Flag URL</label>
                <input type="url" name="flag_url" class="form-control" value="{{ $country->flag_url }}">
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('countries.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
@endsection
