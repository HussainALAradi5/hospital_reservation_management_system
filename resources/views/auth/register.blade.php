@extends('layouts.app')

@section('content')
    <h3>Register</h3>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('auth.register') }}">
        @include('auth.partials._form')
        <button class="btn btn-primary">Register</button>
    </form>

    <p class="mt-3">Already have an account? <a href="{{ route('login') }}">Login here</a></p>
@endsection
