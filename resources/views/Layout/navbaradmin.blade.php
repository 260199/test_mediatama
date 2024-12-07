<style>
    .navbar-brand {
    font-size: 1.5rem;
    font-weight: bold;
}

.nav-link {
    font-size: 1rem;
    margin-right: 15px;
    transition: color 0.3s;
}

.nav-link:hover {
    color: #f0ad4e; /* Warna hover */
}

.navbar {
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}


.footer-links {
    display: flex;
    justify-content: center;
    margin: 20px 0;
}
.footer-links a {
    color: #333;
    margin: 0 15px;
    text-decoration: none;
    font-size: 1em;
}
.copyright {
    font-size: 0.9em;
    color: #333;
}


.footer{
    font-family: 'Arial', sans-serif;
    color: #333;
    margin: 0;
    padding: 0;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    margin-bottom:50px;
}


</style>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        @if(Auth::check())
        <a class="navbar-brand" href="#">Hy, {{ Auth::user()->name }}!</a>
        @else
        @endif

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link active" href="{{ url('dashboard') }}">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('artikel') }}">Artikel</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('tag') }}">Tag</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('kategori') }}">Kategori</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('author') }}">Author</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('logout') }}">Logout</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<body>
    <div class="container mt-5">
        @yield('content')
    </div>
</body>
@include('Layout.footeradmin')

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
