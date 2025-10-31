@extends('layouts.app')

@section('content')
    <div class="text-center">
        @auth
            @if (Auth::user())
                <h1>Welcome {{ Auth::user()->name }} </h1>
            @endif
        @else
            <h1>Welcome Visitor!</h1>
        @endauth
    </div>
@endsection
