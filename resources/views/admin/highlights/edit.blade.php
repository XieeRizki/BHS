@extends('layouts.admin')
@section('title', 'Edit - ' . $highlight->title)
@section('content')

<div style="margin-bottom: 1.5rem;">
    <h1 style="font-size: 1.5rem; font-weight: 700; color: var(--secondary); margin: 0;">Edit Highlight</h1>
    <p style="font-size: 0.85rem; color: var(--neutral); margin: 0;">{{ $highlight->title }}</p>
</div>

<form action="{{ route('admin.highlights.update', $highlight) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    @include('admin.highlights._form', ['highlight' => $highlight])
</form>

@endsection
