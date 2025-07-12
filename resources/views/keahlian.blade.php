@extends('layouts.app')

@section('title', 'Keahlian')

@section('content')
    <h1>Keahlian Saya</h1>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Skill:</h5>
            <ul class="list-group">
                @foreach($skill as $s)
                    <li class="list-group-item">{{ $s }}</li>
                @endforeach
            </ul>
        </div>
    </div>
@endsection