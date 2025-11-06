@extends('layouts.app')

@section('content')
    <h2>Add Medicine Company</h2>
    <form action="{{ route('medicine_companies.store') }}" method="POST">
        @include('medicine_companies.partials._form')
    </form>
@endsection