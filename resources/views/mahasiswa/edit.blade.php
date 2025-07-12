<!-- resources/views/mahasiswa/edit.blade.php -->

@extends('layouts.app')

@section('content')
    <h1>Edit Mahasiswa</h1>

    <form action="{{ route('mahasiswa.update', $mahasiswa->id) }}" method="POST">
        @csrf
        @method('PUT')
        @include('mahasiswa._form')
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
@endsection