<!-- resources/views/mahasiswa/index.blade.php --> 

@extends('layouts.app') 

@section('content') 
    <h1>Data Mahasiswa</h1> 

    <a href="{{ route('mahasiswa.create') }}" class="btn btn-primary">Tambah Mahasiswa</a> 

    <table class="table"> 
        <thead> 
            <tr> 
                <th>Nama</th> 
                <th>NIM</th> 
                <th>Alamat</th> 
                <th>Aksi</th> 
            </tr> 
        </thead> 
        <tbody> 
            @foreach ($mahasiswas as $mahasiswa) 
                <tr> 
                    <td>{{ $mahasiswa->nama }}</td>
                    <td>{{ $mahasiswa->nim }}</td> 
                    <td>{{ $mahasiswa->alamat }}</td> 
                    <td> 
                        <a href="{{ route('mahasiswa.edit', $mahasiswa->id) }}" class="btn btn-warning">Edit</a> 
                        <form action="{{ route('mahasiswa.destroy', $mahasiswa->id) }}" method="POST" style="display: inline;"> 
                            @csrf 
                            @method('DELETE') 
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Kita yakin?')">Hapus</button> 
                        </form> 
                    </td> 
                </tr> 
            @endforeach 
        </tbody> 
    </table> 
@endsection
