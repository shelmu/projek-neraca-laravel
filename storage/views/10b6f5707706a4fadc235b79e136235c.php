

<?php $__env->startSection('title', 'Login'); ?>

<?php $__env->startSection('content'); ?>
<div class="card shadow-lg border-0">
    <div class="card-body p-4">
        <h3 class="text-center fw-bold mb-4">LOGIN</h3>
        
        <?php if(session('error')): ?>
            <div class="alert alert-danger"><?php echo e(session('error')); ?></div>
        <?php endif; ?>

        <form action="<?php echo e(route('login')); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <div class="mb-3">
                <label class="form-label">NIM</label>
                <input type="text" name="nim" class="form-control" required autofocus>
            </div>
            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            <div class="d-grid gap-2">
                <button type="submit" class="btn btn-warning fw-bold">Masuk</button>
            </div>
        </form>
        
        <div class="text-center mt-3">
            <a href="<?php echo e(route('register')); ?>" class="text-decoration-none">Daftar Akun Baru</a>
        </div>
    </div>
</div>
<div class="text-center mt-3">
    <a href="<?php echo e(url('/')); ?>" class="text-white-50 text-decoration-none small">&larr; Kembali ke Beranda</a>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.auth', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\projek-neraca\resources\views/login.blade.php ENDPATH**/ ?>