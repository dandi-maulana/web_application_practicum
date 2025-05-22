<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Tidak Ditemukan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="alert alert-danger">
            <h4 class="alert-heading">Data Mahasiswa Tidak Ditemukan</h4>
            <p>Mahasiswa dengan ID yang diminta tidak ditemukan dalam database.</p>
            <hr>
            <a href="{{ url('/nilai') }}" class="btn btn-primary">Kembali ke Daftar Nilai</a>
        </div>
    </div>
</body>
</html>