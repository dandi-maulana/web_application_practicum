@extends('layouts.app')

@section('title', 'Pendidikan')

@section('content')
    <h1>Riwayat Pendidikan</h1>
    <div class="card">
        <div class="card-body">
            <p><strong>Kampus:</strong> {{ $kampus }}</p>
            <p><strong>Program Studi:</strong> {{ $prodi }}</p>
        </div>
    </div>
@endsection