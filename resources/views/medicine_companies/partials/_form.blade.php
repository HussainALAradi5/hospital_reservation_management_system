@csrf
<div class="mb-3">
    <label>Name</label>
    <input type="text" name="name" class="form-control" value="{{ old('name', $medicineCompany->name ?? '') }}" required>
</div>
<div class="mb-3">
    <label>Code</label>
    <input type="text" name="code" class="form-control" value="{{ old('code', $medicineCompany->code ?? '') }}" required>
</div>
<div class="mb-3">
    <label>Country</label>
    <select name="country_id" class="form-control" required>
        <option value="">Select Country</option>
        @foreach ($countries as $country)
            <option value="{{ $country->id }}" @selected(old('country_id', $medicineCompany->country_id ?? '') == $country->id)>
                {{ $country->name }}
            </option>
        @endforeach
    </select>
</div>
<div class="mb-3">
    <label>Address</label>
    <select name="address_id" class="form-control" required>
        <option value="">Select Address</option>
        @foreach ($addresses as $address)
            <option value="{{ $address->id }}" @selected(old('address_id', $medicineCompany->address_id ?? '') == $address->id)>
                {{ $address->street }} - {{ $address->building }}
            </option>
        @endforeach
    </select>
</div>
<button type="submit" class="btn btn-success">Save</button>