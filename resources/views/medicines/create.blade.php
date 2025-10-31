@extends('layouts.app')

@section('content')
    <h2>Add Medicine</h2>
    <form action="{{ route('medicines.store') }}" method="POST">
        @include('medicines.partials._form')
    </form>
@endsection
