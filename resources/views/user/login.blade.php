<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Login</title>
</head>
<body>

@include('user.top')

<h2>User Login</h2>

@if($errors->any())
    <div style="color: red;">
        @foreach($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    </div>
@endif

@if(session('error'))
    <div style="color: red;">
        <p>{{ session('error') }}</p>
    </div>
@endif

@if(session('success'))
    <div style="color: green;">
        <p>{{ session('success') }}</p>
    </div>
@endif

<form action="{{ route('login_submit') }}" method="POST">
    @csrf
    <table>
        <tr>
            <td>Email:</td>
            <td>
                <input type="email" name="email" placeholder="Email" value="{{ old('email') }}">
            </td>
        </tr>
        <tr>
            <td>Password:</td>
            <td>
                <input type="password" name="password" placeholder="Password">
            </td>
        </tr>
        <tr>
            <td></td>
            <td>
                <input type="submit" value="Login">
            </td>
        </tr>
        <tr>
            <td></td>
            <td>
                <a href="{{ route('forget_password') }}">Forgot Password?</a> |
                <a href="{{ route('register') }}">Register here</a>
            </td>
        </tr>
    </table>
</form>

</body>
</html>
