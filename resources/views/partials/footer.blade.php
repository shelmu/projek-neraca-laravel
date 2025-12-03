<footer class="bg-dark text-white-50 text-center py-4 border-top border-secondary mt-5">
    <div class="container">
        <p class="mb-1 small">
            @auth
                @if(Auth::user()->role == 'admin') Panel Admin @else Portal Anggota @endif
            @else
                Sistem Informasi Organisasi
            @endauth
        </p>
        <small>&copy; {{ date('Y') }} Aplikasi Neraca.</small>
        <p class="mt-2 mb-0 fw-bold text-warning" style="font-size: 0.8rem;">Design by: -</p>
    </div>
</footer>