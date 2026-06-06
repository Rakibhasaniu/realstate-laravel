<h2>Admin Forgot Password</h2>

@if($errors->any())
    <div>
        @foreach($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    </div>
@endif
@if(session('success'))
    <div>
        <p>{{ session('success') }}</p>
    </div>
@endif

<form action="{{ route('admin.forget_password_submit') }}" method="post">
    @csrf
    <table>
        <tr>
            <td>Email:</td>
            <td>
                <input type="email" name="email" placeholder="Enter your email" value="{{ old('email') }}">
            </td>
        </tr>
        <tr>
            <td></td>
            <td>
                <input type="submit" value="Send Reset Link">
            </td>
        </tr>
        <tr>
            <td></td>
            <td>
                <a href="{{ route('admin_login') }}">Back to Login</a>
            </td>
        </tr>
    </table>
</form>
