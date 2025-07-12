<!DOCTYPE html>
<html>
<head>
    <title>Daftar File yang Telah Diupload</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .file-item {
            border: 1px solid #ddd;
            padding: 15px;
            margin-bottom: 15px;
            border-radius: 5px;
        }
        .file-preview {
            max-width: 200px;
            max-height: 200px;
            object-fit: cover;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <h2>Daftar File yang Telah Diupload</h2>
                
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif

                <a href="{{ route('upload.form') }}" class="btn btn-primary mb-3">Upload File Baru</a>

                @if(count($filteredFiles) > 0)
                    <div class="row">
                        @foreach ($filteredFiles as $file)
                            <div class="col-md-4 mb-3">
                                <div class="file-item">
                                    <div class="text-center">
                                        @if(in_array(strtolower($file['type']), ['jpg', 'jpeg', 'png']))
                                            <img src="{{ $file['url'] }}" alt="Gambar" class="file-preview img-fluid" 
                                                 onerror="this.style.display='none'; this.nextElementSibling.style.display='block';">
                                            <div class="alert alert-danger" style="display:none;">
                                                <small>
                                                    <strong>Error Loading Image!</strong><br>
                                                    URL: {{ $file['url'] }}<br>
                                                    File exists: {{ $file['exists'] ? 'Yes' : 'No' }}<br>
                                                    Full path: {{ $file['full_path'] }}
                                                </small>
                                            </div>
                                        @else
                                            <div class="p-4 bg-light">
                                                <i class="fas fa-file-pdf fa-3x text-danger"></i>
                                                <p class="mt-2">PDF File</p>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="mt-2">
                                        <p class="mb-1"><strong>Nama:</strong> {{ $file['name'] }}</p>
                                        <p class="mb-1"><strong>Ukuran:</strong> {{ number_format($file['size'] / 1024, 2) }} KB</p>
                                        <p class="mb-2"><strong>Tipe:</strong> {{ strtoupper($file['type']) }}</p>
                                        
                                        <div class="btn-group" role="group">
                                            <a href="{{ $file['url'] }}" target="_blank" class="btn btn-sm btn-success">Lihat</a>
                                            <a href="{{ $file['url'] }}" download="{{ $file['name'] }}" class="btn btn-sm btn-info">Download</a>
                                            <form action="{{ route('files.delete', $file['name']) }}" method="POST" style="display: inline;" onsubmit="return confirm('Yakin ingin menghapus file ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="alert alert-info">
                        Belum ada file yang diupload.
                    </div>
                @endif
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
</body>
</html>