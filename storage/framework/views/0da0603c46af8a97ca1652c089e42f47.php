<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $__env->yieldContent('title', 'Aplikasi Neraca'); ?></title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    
    <!-- Style Tambahan untuk Navbar Aktif -->
    <style>
        .nav-link.active {
            color: #ffc107 !important; /* Warna Warning Bootstrap */
            font-weight: bold;
        }
    </style>
</head>
<body class="bg-dark text-white d-flex flex-column min-vh-100">

    <!-- 1. Panggil Navbar Sakti -->
    <?php echo $__env->make('partials.navbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <!-- 2. Konten Utama (Berubah-ubah tiap halaman) -->
    <main class="flex-grow-1">
        <?php echo $__env->yieldContent('content'); ?>
    </main>

    <!-- 3. Panggil Footer -->
    <?php echo $__env->make('partials.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <!-- Script JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html><?php /**PATH C:\laragon\www\projek-neraca\resources\views/layouts/app.blade.php ENDPATH**/ ?>