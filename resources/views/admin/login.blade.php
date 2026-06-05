<h2>Admin Login</h2>

@if($errors->any())
    <div>
        @foreach($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    </div>
@endif
@if(session('error'))
    <div>
        <p>{{ session('error') }}</p>
    </div>
@endif
@if(session('success'))
    <div>
        <p>{{ session('success') }}</p>
    </div>
@endif

<form action="{{ route('admin_login_submit')}}" method="post">
    @csrf
    <table>
        <tr>
            <td>Email:</td>
            <td>
                <input type="text" name="email" placeholder="Email">
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
    </table>
</form>
