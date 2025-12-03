<footer class="bg-dark text-white-50 text-center py-4 border-top border-secondary mt-5">
    <div class="container">
        <p class="mb-1 small">
            <?php if(auth()->guard()->check()): ?>
                <?php if(Auth::user()->role == 'admin'): ?> Panel Admin <?php else: ?> Portal Anggota <?php endif; ?>
            <?php else: ?>
                Sistem Informasi Organisasi
            <?php endif; ?>
        </p>
        <small>&copy; <?php echo e(date('Y')); ?> Aplikasi Neraca.</small>
        <p class="mt-2 mb-0 fw-bold text-warning" style="font-size: 0.8rem;">Design by: -</p>
    </div>
</footer><?php /**PATH C:\laragon\www\projek-neraca\resources\views/partials/footer.blade.php ENDPATH**/ ?>