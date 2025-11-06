@extends('layouts.app')

@section('content')
    <h2>Edit Medicine Company</h2>
    <form action="{{ route('medicine_companies.update', $medicineCompany) }}" method="POST">
        @method('PUT')
        @include('medicine_companies.partials._form')
    </form>
@endsection