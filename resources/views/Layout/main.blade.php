<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task 3 Development With Framework Laravel</title>
    @include('Layout.css')
</head>
<div class="container">
    <div class="header">
        <div class="search-bar">
            <input type="text" placeholder="Search">
        </div>
        <div class="logo">
            <span>the news</span>
            <span>dispatch.</span>
        </div>
        <div class="auth-buttons">
            <!-- Periksa apakah pengguna sudah login -->
            @if(Auth::check())
                <span class="welcome-text">Selamat datang, {{ Auth::user()->name }}. </span>
                <div class="dropdown" style="margin-left:10px;">
                    <button class="dropdown-toggle" id="dropdownMenuButton">Aksi</button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="{{ url('dashboard') }}">Dashboard</a>
                        <a class="dropdown-item" href="{{ url('logout') }}">Logout</a>
                    </div>
                </div>
            @else
                <a href="{{ route('login') }}">Sign in</a>
            @endif
            <a href="#" class="subscribe" id="subscribe-button">Subscribe</a>
        </div>
        
    </div>
    @include('Layout.nav')
</div>
    <body>
        @yield('isi')
@include('Layout.footer')
</body>
@include('Layout.js')
</html>