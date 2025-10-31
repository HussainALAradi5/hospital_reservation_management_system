@csrf
<div class="mb-3">
    <label>Code</label>
    <input type="text" name="code" class="form-control" value="{{ old('code', $medicine->code ?? '') }}" required>
</div>
<div class="mb-3">
    <label>Name</label>
    <input type="text" name="name" class="form-control" value="{{ old('name', $medicine->name ?? '') }}" required>
</div>
<div class="mb-3">
    <label>Description</label>
    <textarea name="description" class="form-control" required>{{ old('description', $medicine->description ?? '') }}</textarea>
</div>
<div class="mb-3">
    <label>Quantity</label>
    <input type="number" name="quantity" class="form-control" value="{{ old('quantity', $medicine->quantity ?? 0) }}"
        required>
</div>
<div class="mb-3">
    <label>Country</label>
    <select name="product_country_id" class="form-control" required>
        <option value="">Select Country</option>
        @foreach ($countries as $country)
            <option value="{{ $country->id }}"
                {{ old('product_country_id', $medicine->product_country_id ?? '') == $country->id ? 'selected' : '' }}>
                {{ $country->name }}
            </option>
        @endforeach
    </select>
</div>
<button type="submit" class="btn btn-success">Save</button>
