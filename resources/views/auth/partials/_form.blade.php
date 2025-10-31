@csrf

<input type="text" name="name" class="form-control mb-2" placeholder="Name"
    value="{{ old('name', $user->name ?? '') }}" required>

<input type="email" name="email" class="form-control mb-2" placeholder="Email"
    value="{{ old('email', $user->email ?? '') }}" required>

<input type="password" name="password" class="form-control mb-2" placeholder="Password"
    @if (!isset($user)) required @endif>

<input type="number" name="age" class="form-control mb-2" placeholder="Age"
    value="{{ old('age', $user->age ?? '') }}" required>

<select name="gender_type" class="form-control mb-2" required>
    <option value="">Gender</option>
    <option value="M" @selected(old('gender_type', $user->gender_type ?? '') === 'M')>Male</option>
    <option value="F" @selected(old('gender_type', $user->gender_type ?? '') === 'F')>Female</option>
</select>

<select name="is_married" class="form-control mb-2" required>
    <option value="">Marital Status</option>
    <option value="1" @selected(old('is_married', $user->is_married ?? '') == 1)>Married</option>
    <option value="0" @selected(old('is_married', $user->is_married ?? '') == 0)>Single</option>
</select>

<select name="user_type" class="form-control mb-2" required>
    <option value="">User Type</option>
    @foreach (['patient', 'doctor', 'nurse', 'pharmancy'] as $type)
        <option value="{{ $type }}" @selected(old('user_type', $user->user_type ?? '') === $type)>
            {{ ucfirst($type) }}
        </option>
    @endforeach
</select>
