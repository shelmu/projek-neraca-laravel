<!-- Penambahan class 'sticky-top' dan 'bg-dark' -->
<nav class="navbar navbar-expand-lg border-bottom border-secondary mb-0 sticky-top bg-dark">
    <div class="container">
        <!-- Logo Text Warning (Kuning/Oranye) -->
        <a class="navbar-brand fw-bold text-warning" href="{{ url('/') }}">
            <i class="bi bi-wallet2 me-2"></i> NERACA
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto align-items-center">
                
                @guest
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ url('/') }}">Beranda</a>
                    </li>
                    <li class="nav-item ms-lg-3">
                        <!-- Tombol Login Warning (Oranye) -->
                        <a href="{{ route('login') }}" class="btn btn-warning text-dark fw-bold px-4">
                            Login Anggota
                        </a>
                    </li>
                @endguest

                @auth
                    @if(Auth::user()->role == 'admin')
                        <li class="nav-item"><a class="nav-link" href="{{ route('dashboard.admin') }}">Dashboard</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('anggota.index') }}">Anggota</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('kas.index') }}">Kas</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('progja.index') }}">Progja</a></li>
                    @else
                        <li class="nav-item"><a class="nav-link" href="{{ route('dashboard.anggota') }}">Dashboard Saya</a></li>
                    @endif

                    <li class="nav-item dropdown ms-lg-3">
                        <a class="nav-link dropdown-toggle text-warning fw-bold" href="#" role="button" data-bs-toggle="dropdown">
                            {{ Auth::user()->nama }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="button" class="dropdown-item text-danger" onclick="this.closest('form').submit()">
                                        <i class="bi bi-box-arrow-right me-2"></i> Logout
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </li>
                @endauth

            </ul>
        </div>
    </div>
</nav>