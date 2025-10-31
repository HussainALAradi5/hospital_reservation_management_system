@extends('layouts.app')

@section('content')
    <h3>Login</h3>

    @if ($errors->has('login'))
        <div class="alert alert-danger">
            {{ $errors->first('login') }}
        </div>
    @endif

    <form method="POST" action="{{ route('auth.login') }}">
        @csrf
        <input type="text" name="login" class="form-control mb-2" placeholder="Name or Email" required>
        <input type="password" name="password" class="form-control mb-2" placeholder="Password" required>
        <button class="btn btn-success">Login</button>
    </form>

    <p class="mt-3">Don't have an account? <a href="{{ route('register') }}">Register here</a></p>
@endsection
