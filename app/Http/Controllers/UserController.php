<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Hospital;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('hospital')->get();
        return view('users.index', compact('users'));
    }

    public function create()
    {
        $hospitals = Hospital::all();
        return view('users.create', compact('hospitals'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:users,name',
            'email' => 'required|string|email|unique:users,email',
            'password' => 'required|string|min:6',
            'telephone_number' => 'required|string',
            'age' => 'required|integer|min:0',
            'gender_type' => 'required|in:M,F',
            'is_married' => 'required|boolean',
            'user_type' => 'required|in:doctor,nurse,pharmacist,admin,patient',
            'hospital_id' => 'nullable|exists:hospitals,id',
        ]);

        if (in_array($request->user_type, ['doctor', 'nurse', 'pharmacist', 'patient']) && !$request->hospital_id) {
            return back()->withErrors(['hospital_id' => 'Hospital is required for this user type.'])->withInput();
        }

        $data = $request->all();
        $data['password'] = bcrypt($data['password']);

        User::create($data);

        return redirect()->route('users.index')->with('success', 'User registered.');
    }

    public function edit(User $user)
    {
        $hospitals = Hospital::all();
        return view('users.edit', compact('user', 'hospitals'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|unique:users,name,' . $user->id,
            'email' => 'required|string|email|unique:users,email,' . $user->id,
            'telephone_number' => 'required|string',
            'age' => 'required|integer|min:0',
            'gender_type' => 'required|in:M,F',
            'is_married' => 'required|boolean',
            'user_type' => 'required|in:doctor,nurse,pharmacist,admin,patient',
            'hospital_id' => 'nullable|exists:hospitals,id',
        ]);

        if (in_array($request->user_type, ['doctor', 'nurse', 'pharmacist', 'patient']) && !$request->hospital_id) {
            return back()->withErrors(['hospital_id' => 'Hospital is required for this user type.'])->withInput();
        }

        $user->update($request->except('password'));

        return redirect()->route('users.index')->with('success', 'User updated.');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')->with('success', 'User deleted.');
    }
}