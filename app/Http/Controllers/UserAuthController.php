<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserAuthController extends Controller
{
    public function showForm() {
        return view('login');
    }

    public function register(Request $request) {
        $validata_array = [
            'name'=> 'required|string|unique:users,name',
            'email'=> 'required|string|unique:users,name',
            'password'=> 'required|string|min:6',
            'telephone_number' => 'required|string',
            'age' => 'required|integer|min:0',
            'gender_type' => 'required|in:M,F',
            'is_married' => 'required|boolean',
        ];
        $request->validate($validata_array);

        $user_array = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'telephone_number' => $request->telephone_number,
            'age' => $request->age,
            'gender_type' => $request->gender_type,
            'is_married' => $request->is_married,

        ];
        User::create($user_array);

        return redirect()->route('login')->with('success', 'Registration successful. You can now log in.');

    }

    public function login(Request $request) {
        $validate_array = [
            'login' => 'required|string',
            'password' => 'required|string',

        ];
        $request->validate($validate_array);
        $loginField = filter_var($request->login,FILTER_VALIDATE_EMAIL) ? 'email' : 'name';
        if (Auth::attempt([$loginField => $request->login, 'password' => $request->password])){
            return redirect()->route('medicines.index');
        }
        return back()->withErrors(['login' => 'Invalid Credntials']);
    }

    public function logout() {
        Auth::logout();
        return redirect()->route('login');
    }

    public function showRegisterForm()
{
    return view('auth.register');
}

    public function profile()
{
    $user = Auth::user();
    return view('auth.profile', compact('user'));
}

public function showLoginForm()
{
    return view('auth.login');
}
}
