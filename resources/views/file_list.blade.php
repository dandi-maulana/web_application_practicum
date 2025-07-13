<!DOCTYPE html>
<html>
<head>
    <title>File List</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        <h2>File List</h2>
                        <a href="{{ route('upload.form') }}" class="btn btn-primary btn-sm float-right">Upload New File</a>
                    </div>
                    <div class="card-body">
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

                        @if(count($fileDetails) > 0)
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Preview</th>
                                            <th>File Name</th>
                                            <th>Size</th>
                                            <th>Last Modified</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($fileDetails as $index => $file)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>
                                                    <img src="{{ $file['url'] }}" alt="{{ $file['name'] }}" style="width: 50px; height: 50px; object-fit: cover;">
                                                </td>
                                                <td>{{ $file['name'] }}</td>
                                                <td>{{ round($file['size'] / 1024, 2) }} KB</td>
                                                <td>{{ date('Y-m-d H:i:s', $file['lastModified']) }}</td>
                                                <td>
                                                    <a href="{{ $file['url'] }}" target="_blank" class="btn btn-info btn-sm">View</a>
                                                    <a href="{{ route('files.download', $file['name']) }}" class="btn btn-success btn-sm">Download</a>
                                                    <form action="{{ route('files.delete', $file['name']) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this file?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <p>No files uploaded yet.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>