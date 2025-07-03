@extends('layouts.app')

@section('content')
<div class="container" style="max-width:600px">
    <h2>Tambah User</h2>

    {{-- tampilkan validasi --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $e) <li>{{ $e }}</li>@endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('users.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label class="form-label">Nama</label>
            <input type="text" name="name" class="form-control"
                   value="{{ old('name') }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control"
                   value="{{ old('email') }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Level</label>
            <select name="level" class="form-select" required>
                <option value="" disabled selected>-- pilih level --</option>
                <option value="admin">Admin</option>
                <option value="user">User</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Password</label>
            <input type="password" name="password" class="form-control" required>
        </div>

        <button class="btn btn-success">Simpan</button>
        <a href="{{ route('users.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
