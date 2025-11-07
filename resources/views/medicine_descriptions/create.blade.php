@extends('layouts.app')

@section('content')
    <h2 class="mb-4">Write Medicine Description</h2>

    <form method="POST" action="{{ route('medicine_descriptions.store') }}" class="row g-3">
        @csrf

        <div class="col-md-6">
            <label class="form-label">Code</label>
            <input type="text" name="code" class="form-control" required>
        </div>

        <div class="col-md-6">
            <label class="form-label">Name</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <div class="col-12">
            <label class="form-label">Description</label>
            <textarea name="description" class="form-control" rows="3"></textarea>
        </div>

        <div class="col-md-4">
            <label class="form-label">Quantity</label>
            <input type="number" name="quantity" class="form-control" required>
        </div>

        <div class="col-md-4">
            <label class="form-label">Number of Days</label>
            <input type="number" name="number_of_days" class="form-control" required>
        </div>

        <div class="col-md-4">
            <label class="form-label">Medicine</label>
            <select name="medicine_id" class="form-select" required>
                <option value="">Select</option>
                @foreach ($medicines as $med)
                    <option value="{{ $med->id }}">{{ $med->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="col-md-6">
            <label class="form-label">Patient</label>
            <select name="writed_for_user_id" class="form-select" required>
                <option value="">Select</option>
                @foreach ($patients as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="col-md-6">
            <label class="form-label">Hospital</label>
            <select name="hospital_id" class="form-select" required>
                <option value="">Select</option>
                @foreach ($hospitals as $hospital)
                    <option value="{{ $hospital->id }}">{{ $hospital->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="col-12 text-center">
            <button class="btn btn-success">Save Description</button>
        </div>
    </form>
@endsection