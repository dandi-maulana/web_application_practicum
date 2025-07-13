<!DOCTYPE html>
<html>
<head>
    <title>File Upload</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h2>File Upload</h2>
                    </div>
                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                                @if(session('file'))
                                    <br>
                                    <a href="{{ Storage::url(session('file')) }}" target="_blank" class="btn btn-sm btn-info mt-2">View File</a>
                                @endif
                            </div>
                        @endif

                        @if (session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif

                        <form action="{{ route('upload.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="file">Choose Image File (JPG, JPEG, PNG - Max 2MB)</label>
                                <input type="file" name="file" id="file" class="form-control @error('file') is-invalid @enderror" accept="image/*">
                                @error('file')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary">Upload</button>
                            <a href="{{ route('files.list') }}" class="btn btn-secondary">View All Files</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>