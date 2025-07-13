<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Dashboard</div>
                    <div class="card-body">
                        @if(session('success'))
                            <div class="alert alert-info">{{ session('success') }}</div>
                        @endif
                        <p>Welcome, {{ auth()->user()->email }}</p>
                        <h1>Halaman Dashboard</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>