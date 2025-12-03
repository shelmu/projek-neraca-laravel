<!-- Penambahan class 'sticky-top' dan 'bg-dark' -->
<nav class="navbar navbar-expand-lg border-bottom border-secondary mb-0 sticky-top bg-dark">
    <div class="container">
        <!-- Logo Text Warning (Kuning/Oranye) -->
        <a class="navbar-brand fw-bold text-warning" href="<?php echo e(url('/')); ?>">
            <i class="bi bi-wallet2 me-2"></i> NERACA
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto align-items-center">
                
                <?php if(auth()->guard()->guest()): ?>
                    <li class="nav-item">
                        <a class="nav-link active" href="<?php echo e(url('/')); ?>">Beranda</a>
                    </li>
                    <li class="nav-item ms-lg-3">
                        <!-- Tombol Login Warning (Oranye) -->
                        <a href="<?php echo e(route('login')); ?>" class="btn btn-warning text-dark fw-bold px-4">
                            Login Anggota
                        </a>
                    </li>
                <?php endif; ?>

                <?php if(auth()->guard()->check()): ?>
                    <?php if(Auth::user()->role == 'admin'): ?>
                        <li class="nav-item"><a class="nav-link" href="<?php echo e(route('dashboard.admin')); ?>">Dashboard</a></li>
                        <li class="nav-item"><a class="nav-link" href="<?php echo e(route('anggota.index')); ?>">Anggota</a></li>
                        <li class="nav-item"><a class="nav-link" href="<?php echo e(route('kas.index')); ?>">Kas</a></li>
                        <li class="nav-item"><a class="nav-link" href="<?php echo e(route('progja.index')); ?>">Progja</a></li>
                    <?php else: ?>
                        <li class="nav-item"><a class="nav-link" href="<?php echo e(route('dashboard.anggota')); ?>">Dashboard Saya</a></li>
                    <?php endif; ?>

                    <li class="nav-item dropdown ms-lg-3">
                        <a class="nav-link dropdown-toggle text-warning fw-bold" href="#" role="button" data-bs-toggle="dropdown">
                            <?php echo e(Auth::user()->nama); ?>

                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <form action="<?php echo e(route('logout')); ?>" method="POST">
                                    <?php echo csrf_field(); ?>
                                    <button type="button" class="dropdown-item text-danger" onclick="this.closest('form').submit()">
                                        <i class="bi bi-box-arrow-right me-2"></i> Logout
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </li>
                <?php endif; ?>

            </ul>
        </div>
    </div>
</nav><?php /**PATH C:\laragon\www\projek-neraca\resources\views/partials/navbar.blade.php ENDPATH**/ ?>