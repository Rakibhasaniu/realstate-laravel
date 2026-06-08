<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
</head>
<body>

@include('user.top')

<h2>User Dashboard</h2>

<p>Welcome, {{ Auth::guard('web')->user()->name }}!</p>

</body>
</html>
