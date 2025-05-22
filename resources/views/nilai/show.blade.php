<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nilai Mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Nilai Mahasiswa</h1>
        
        <div class="card mb-4">
            <div class="card-header">
                <h2>Informasi Mahasiswa</h2>
            </div>
            <div class="card-body">
                <p><strong>Nama:</strong> {{ $mahasiswa->nama }}</p>
                <p><strong>NIM:</strong> {{ $mahasiswa->nim }}</p>
                <p><strong>Alamat:</strong> {{ $mahasiswa->alamat ?? '-' }}</p>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h2>Daftar Nilai</h2>
            </div>
            <div class="card-body">
                @if($mahasiswa->nilai->isEmpty())
                    <p class="text-muted">Mahasiswa ini belum memiliki nilai.</p>
                @else
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Mata Kuliah</th>
                                <th>Kode</th>
                                <th>SKS</th>
                                <th>Nilai</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($mahasiswa->nilai as $index => $nilai)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $nilai->matakuliah->nama }}</td>
                                    <td>{{ $nilai->matakuliah->kode }}</td>
                                    <td>{{ $nilai->matakuliah->sks }}</td>
                                    <td>{{ $nilai->nilai }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>

        <a href="{{ url('/nilai') }}" class="btn btn-primary mt-3">Kembali ke Daftar Nilai</a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>