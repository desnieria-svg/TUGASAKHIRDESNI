<?php $__env->startSection('title', 'Profil Saya'); ?>
<?php $__env->startSection('content'); ?>

<div class="profile-page">
    <h1 class="profile-title">👤 Profil Saya</h1>
    <p class="profile-sub">Kelola informasi akun, password, dan preferensi keamanan Anda.</p>

    <div class="profile-section">
        <?php echo $__env->make('profile.partials.update-profile-information-form', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    </div>

    <div class="profile-section">
        <?php echo $__env->make('profile.partials.update-password-form', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    </div>

    <div class="profile-section profile-danger-section">
        <?php echo $__env->make('profile.partials.delete-user-form', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\BioAquaLab\BioAquaLab\resources\views/profile/edit.blade.php ENDPATH**/ ?>