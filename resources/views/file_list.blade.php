<!DOCTYPE html>
<html>
<head>
    <title>File List</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h2>Daftar File yang Telah Diupload</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <ul class="list-group">
        @foreach ($files as $file)
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <img href="{{ Storage::url($file) }}" target="_blank">{{ basename($file) }}</img>
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
