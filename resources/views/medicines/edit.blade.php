@extends('layouts.app')

@section('content')
    <h2>Edit Medicine</h2>
    <form action="{{ route('medicines.update', $medicine) }}" method="POST">
        @method('PUT')
        @include('medicines.partials._form')
    </form>
@endsection
