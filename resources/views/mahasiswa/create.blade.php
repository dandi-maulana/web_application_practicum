<!-- resources/views/mahasiswa/create.blade.php -->
  
@extends('layouts.app') 
  
@section('content') 
    <h1>Tambah Mahasiswa</h1> 

    <form action="{{ route('mahasiswa.store') }}" method="POST"> 
        @csrf 
        @include('mahasiswa._form') 
        <button type="submit" class="btn btn-primary">Simpan</button> 
    </form> 
@endsection