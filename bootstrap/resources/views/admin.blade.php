<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
</head>
<body>
    <h2>Welcome to Admin Dashboard, {{ Auth::user()->name }}</h2>
    <a href="{{ route('logout') }}">Logout</a>
</body>
</html>