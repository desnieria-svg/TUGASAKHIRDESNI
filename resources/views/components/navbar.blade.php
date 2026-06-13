<nav class="navbar">
    <div class="navbar-container">
        <!-- Logo di sebelah kiri -->
        <div class="navbar-brand">
            <img src="{{ asset('images/logo.png') }}" alt="BioAqua Lab" height="40">
            <span>BioAqua Lab</span>
        </div>

        <!-- Menu di sebelah kanan -->
        <ul class="navbar-menu">
            <li><a href="{{ url('/') }}" class="{{ request()->is('/') ? 'active' : '' }}">Beranda</a></li>
            <li><a href="{{ url('/tentang') }}" class="{{ request()->is('tentang') ? 'active' : '' }}">Tentang</a></li>
            <li><a href="{{ url('/kontak') }}" class="{{ request()->is('kontak') ? 'active' : '' }}">Kontak</a></li>

            @auth
                {{-- Tampilkan nama user jika sudah login --}}
                <li>
                    <span class="user-greeting">👤 {{ auth()->user()->name }}</span>
                </li>
                <li>
                    <a href="{{ url('/dashboard') }}" class="btn-dashboard {{ request()->is('dashboard') ? 'active' : '' }}">Dashboard</a>
                </li>
                <li>
                    <form action="{{ route('logout') }}" method="POST" style="display:inline">
                        @csrf
                        <button type="submit" class="btn-logout">Logout</button>
                    </form>
                </li>
            @else
                {{-- Tampilkan tombol login jika belum login --}}
                <li>
                    <a href="{{ route('login') }}" class="btn-dashboard">Login</a>
                </li>
            @endauth
        </ul>
    </div>
</nav>

<style>
.navbar {
    background: #fff;
    padding: 15px 0;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    width: 100%;
    top: 0;
    z-index: 1000;
}

.navbar-container {
    width: 95%;
    max-width: 100%;
    margin: 0 auto;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.navbar-brand {
    display: flex;
    align-items: center;
    gap: 12px;
    font-weight: bold;
    color: #0369a1;
    font-size: 1.2rem;
}

.navbar-menu {
    list-style: none;
    margin: 0;
    padding: 0;
    display: flex;
    gap: 30px;
    align-items: center;
}

.navbar-menu a {
    text-decoration: none;
    color: #334155;
    font-weight: 500;
    transition: 0.3s;
}

/* Nama user */
.user-greeting {
    color: #0369a1;
    font-weight: 600;
    font-size: 0.95rem;
}

/* Tombol Dashboard Biru */
.btn-dashboard {
    background: #3b82f6;
    color: #fff !important;
    padding: 10px 20px;
    border-radius: 8px;
    box-shadow: 0 4px 6px rgba(59, 130, 246, 0.2);
}

.btn-dashboard:hover {
    background: #2563eb;
    transform: translateY(-2px);
}

/* Tombol Logout */
.btn-logout {
    background: #ef4444;
    color: #fff;
    padding: 10px 20px;
    border-radius: 8px;
    border: none;
    font-weight: 500;
    cursor: pointer;
    transition: 0.3s;
}

.btn-logout:hover {
    background: #dc2626;
    transform: translateY(-2px);
}
</style>