@extends('layouts.main')

@section('title', 'create owners')

@section('content')

<form method="POST" action="{{ route('owners.store') }}">
    @csrf

    <div>
        <label>Company Name</label>
        <input type="text" name="company_name" required>
    </div>

    <div>
        <label>CPF / CNPJ</label>
        <input type="text" name="tax_id" required>
    </div>

    <button type="submit">
        Continue
    </button>
</form>
@endsection