<!DOCTYPE html>
<html>
<head>
    <title>Owner Dashboard</title>
</head>
<body>
    <h2>Welcome to Owner Dashboard, {{ Auth::user()->name }}</h2>
    <a href="{{ route('logout') }}">Logout</a>
</body>
</html>