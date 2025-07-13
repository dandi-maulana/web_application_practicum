<!DOCTYPE html>
<html>
<head>
    <title>Adult Content</title>
</head>
<body>
    <h2>Welcome to Adult Content Page</h2>
    <p>Name: {{ Auth::user()->name }}</p>
    <p>Role: {{ Auth::user()->role }}</p>
    <p>Age: {{ Auth::user()->age }}</p>
    <a href="{{ route('home') }}">Back to Home</a>
</body>
</html>