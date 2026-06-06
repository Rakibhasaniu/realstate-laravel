<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
</head>
<body>

<h2>Admin Dashboard</h2>

<nav>
    <a href="{{ route('admin_dashboard') }}">Dashboard</a> |
    <a href="{{ route('admin_logout') }}">Logout</a>
</nav>

<hr>

<p>Welcome, Admin!</p>

</body>
</html>
