@extends('layouts.app')

@section('content')
    <h2 class="mb-4">Edit Medicine Description</h2>

    <form method="POST" action="{{ route('medicine_descriptions.update', $medicineDescription) }}" class="row g-3">
        @csrf @method('PUT')

        <div class="col-md-6">
            <label class="form-label">Name</label>
            <input type="text" name="name" class="form-control" value="{{ $medicineDescription->name }}" required>
        </div>

        <div class="col-12">
            <label class="form-label">Description</label>
            <textarea name="description" class="form-control" rows="3">{{ $medicineDescription->description }}</textarea>
        </div>

        <div class="col-md-4">
            <label class="form-label">Quantity</label>
            <input type="number" name="quantity" class="form-control" value="{{ $medicineDescription->quantity }}" required>
        </div>

        <div class="col-md-4">
            <label class="form-label">Number of Days</label>
            <input type="number" name="number_of_days" class="form-control" value="{{ $medicineDescription->number_of_days }}" required>
        </div>

        <div class="col-md-4">
            <label class="form-label">Medicine</label>
            <select name="medicine_id" class="form-select" required>
                @foreach ($medicines as $med)
                    <option value="{{ $med->id }}" @selected($med->id == $medicineDescription->medicine_id)>
                        {{ $med->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="col-md-6">
            <label class="form-label">Patient</label>
            <select name="writed_for_user_id" class="form-select" required>
                @foreach ($patients as $user)
                    <option value="{{ $user->id }}" @selected($user->id == $medicineDescription->writed_for_user_id)>
                        {{ $user->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="col-md-6">
            <label class="form-label">Hospital</label>
            <select name="hospital_id" class="form-select" required>
                @foreach ($hospitals as $hospital)
                    <option value="{{ $hospital->id }}" @selected($hospital->id == $medicineDescription->hospital_id)>
                        {{ $hospital->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="col-12 text-center">
            <button class="btn btn-success">Update Description</button>
        </div>
    </form>
@endsection