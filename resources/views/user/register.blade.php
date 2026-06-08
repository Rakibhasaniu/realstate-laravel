<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Register</title>
</head>
<body>

@include('user.top')

<h2>User Registration</h2>

@if($errors->any())
    <div style="color: red;">
        @foreach($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    </div>
@endif

@if(session('success'))
    <div style="color: green;">
        <p>{{ session('success') }}</p>
    </div>
@endif

<form action="{{ route('register_submit') }}" method="POST">
    @csrf
    <table>
        <tr>
            <td>Name:</td>
            <td>
                <input type="text" name="name" placeholder="Full Name" value="{{ old('name') }}">
            </td>
        </tr>
        <tr>
            <td>Email:</td>
            <td>
                <input type="email" name="email" placeholder="Email" value="{{ old('email') }}">
            </td>
        </tr>
        <tr>
            <td>Phone:</td>
            <td>
                <input type="text" name="phone" placeholder="Phone Number" value="{{ old('phone') }}">
            </td>
        </tr>
        <tr>
            <td>Password:</td>
            <td>
                <input type="password" name="password" placeholder="Password">
            </td>
        </tr>
        <tr>
            <td>Confirm Password:</td>
            <td>
                <input type="password" name="password_confirmation" placeholder="Confirm Password">
            </td>
        </tr>
        <tr>
            <td></td>
            <td>
                <input type="submit" value="Register">
            </td>
        </tr>
        <tr>
            <td></td>
            <td>
                Already have account? <a href="{{ route('login') }}">Login here</a>
            </td>
        </tr>
    </table>
</form>

</body>
</html>
