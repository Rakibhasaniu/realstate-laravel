<nav>
    <a href="{{ route('home') }}">Home</a> |
    <a href="{{ route('about') }}">About</a> |

    @guest('web')
        <a href="{{ route('login') }}">Login</a> |
        <a href="{{ route('register') }}">Register</a>
    @endguest

    @auth('web')
        <a href="{{ route('user_dashboard') }}">Dashboard</a> |
        <span>Welcome, {{ Auth::guard('web')->user()->name }}</span> |
        <a href="{{ route('profile') }}">Profile</a>
        <a href="{{ route('logout') }}">Logout</a>
    @endauth
</nav>
<hr>
