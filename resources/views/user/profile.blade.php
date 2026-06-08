<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
</head>
<body>

@include('user.top')

<h2>My Profile</h2>

@if(session('error'))
    {{ session('error') }}
@endif

@if(session('success'))
    {{ session('success') }}
@endif

<form action="{{ route('profile_submit') }}" method="post" enctype="multipart/form-data">
    @csrf
    <table>
        <tr>
            <td>Existing Photo:</td>
            <td>
                @if(Auth::guard('web')->user()->photo == null)
                    No Photo Found
                @else
                    <img src="{{ asset('uploads/'.Auth::guard('web')->user()->photo) }}" alt=""
                    style="width:100px;height:auto;">
                @endif
            </td>
        </tr>
        <tr>
            <td>Change Photo:</td>
            <td>
                <input type="file" name="photo">
            </td>
        </tr>
        <tr>
            <td>Name:</td>
            <td>
                <input type="text" name="name" placeholder="Name" value="{{ Auth::guard('web')->user()->name }}">
            </td>
        </tr>
        <tr>
            <td>Email:</td>
            <td>
                <input type="email" name="email" placeholder="Email" value="{{ Auth::guard('web')->user()->email }}">
            </td>
        </tr>
        <tr>
            <td>Phone:</td>
            <td>
                <input type="text" name="phone" placeholder="Phone" value="{{ Auth::guard('web')->user()->phone }}">
            </td>
        </tr>
        <tr>
            <td>Country:</td>
            <td>
                <input type="text" name="country" placeholder="Country" value="{{ Auth::guard('web')->user()->country }}">
            </td>
        </tr>
        <tr>
            <td>State:</td>
            <td>
                <input type="text" name="state" placeholder="State" value="{{ Auth::guard('web')->user()->state }}">
            </td>
        </tr>
        <tr>
            <td>City:</td>
            <td>
                <input type="text" name="city" placeholder="City" value="{{ Auth::guard('web')->user()->city }}">
            </td>
        </tr>
        <tr>
            <td>Zip:</td>
            <td>
                <input type="text" name="zip" placeholder="Zip" value="{{ Auth::guard('web')->user()->zip }}">
            </td>
        </tr>
        <tr>
            <td>Password:</td>
            <td>
                <input type="password" name="password" placeholder="Leave blank to keep current password">
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
                <input type="submit" value="Update">
            </td>
        </tr>
    </table>
</form>

</body>
</html>
