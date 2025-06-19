<!DOCTYPE html>
<html>
<head>
    <title>Daftar Gambar</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .img-wrapper {
            flex: 1;
            text-align: center;
        }
    </style>
</head>
<body>
<div class="container mt-5">
    <h2 class="mb-4 text-center">Daftar File yang Telah Diupload</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <ul class="list-group">
        @foreach ($files as $file)
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <div class="img-wrapper">
                    <img src="{{ Storage::url($file) }}" alt="Gambar" style="width: 150px; height: auto; object-fit: cover;">
                </div>
                <form action="{{ route('files.delete', basename($file)) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-sm btn-danger">Hapus</button>
                </form>
            </li>
        @endforeach
    </ul>
</div>
</body>
</html>
