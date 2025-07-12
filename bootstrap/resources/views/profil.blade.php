@extends('layouts.app')

@section('title', 'Profil')

@section('content')
    <h1>Profil Saya</h1>
    <div class="card">
        <div class="card-body">
            <p><strong>Nama:</strong> {{ $nama }}</p>
            <p><strong>NPM:</strong> {{ $npm }}</p>
        </div>
    </div>
@endsection