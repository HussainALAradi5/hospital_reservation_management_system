<?php

namespace App\Http\Controllers;

use App\Models\Hospital;
use App\Models\User;
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
            'email' => 'required|string|unique:users,email',
            'password' => 'required|string|min:6',
            'telephone_number' => 'required|string',
            'age' => 'required|integer|min:0',
            'gender_type' => 'required|in:M,F',
            'is_married' => 'required|boolean',
            'user_type' => 'required|in:doctor,nurse,pharmacist,admin,patient',
            'hospital_id' => 'nullable|exists:hospitals,id',
        ]);

        if (!in_array($request->user_type, ['admin', 'patient']) && !$request->hospital_id) {
            return back()->withErrors(['hospital_id' => 'Hospital is required for medical staff.']);
        }

        $data = $request->all();
        $data['password'] = bcrypt($data['password']);

        User::create($data);

        return redirect()->route('users.index')->with('success', 'User registered.');
    }
}
