<?php $__env->startSection('title','Kontak Kami'); ?>
<?php $__env->startSection('content'); ?>
<div style="background:transparent;min-height:100vh;padding:40px 16px;">
<div style="max-width:860px;margin:0 auto;">

  <div style="margin-bottom:28px;text-align:center;">
    <div style="display:inline-flex;align-items:center;gap:6px;background:#dbeafe;color:#1d4ed8;padding:4px 14px;border-radius:99px;font-size:0.8rem;font-weight:600;margin-bottom:12px;">📞 Hubungi Kami</div>
    <h1 style="font-size:2rem;font-weight:800;color:#0f172a;margin:0 0 8px;">Kontak BioAqua Lab</h1>
    <p style="color:#64748b;font-size:1rem;">Ada pertanyaan? Kami siap membantu kamu!</p>
  </div>

  <div style="display:grid;grid-template-columns:1fr 1fr;gap:20px;margin-bottom:24px;">
    <?php $__currentLoopData = ['📍 Alamat'=>'Jl. Tirta Murni No. 24, Bandung, Jawa Barat 40123','📞 Telepon'=>'+62 22 123-456','📱 WhatsApp'=>'+62 812-3456-7890','✉️ Email'=>'info@bioaqua.lab','🕐 Jam Kerja'=>'Senin–Sabtu: 07.00 – 18.00 WIB']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $label=>$val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div style="background:#fff;border-radius:14px;padding:20px;box-shadow:0 2px 10px rgba(0,0,0,0.05);border:1px solid #e2e8f0;display:flex;align-items:flex-start;gap:14px;">
      <div style="font-size:1.5rem;flex-shrink:0;"><?php echo e(explode(' ',$label)[0]); ?></div>
      <div>
        <div style="font-size:0.78rem;color:#94a3b8;margin-bottom:3px;"><?php echo e(implode(' ',array_slice(explode(' ',$label),1))); ?></div>
        <div style="font-size:0.9rem;font-weight:600;color:#1e293b;"><?php echo e($val); ?></div>
      </div>
    </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    <div style="background:linear-gradient(135deg,#0ea5e9,#0284c7);border-radius:14px;padding:20px;color:#fff;display:flex;align-items:center;gap:14px;">
      <div style="font-size:2rem;">💬</div>
      <div>
        <div style="font-size:0.9rem;font-weight:700;margin-bottom:4px;">Chat WhatsApp</div>
        <a href="https://wa.me/6281234567890" style="background:rgba(255,255,255,0.2);color:#fff;padding:6px 14px;border-radius:8px;font-size:0.8rem;font-weight:600;text-decoration:none;">Mulai Chat →</a>
      </div>
    </div>
  </div>

  <div style="text-align:center;">
    <a href="<?php echo e(url('/')); ?>" style="display:inline-flex;align-items:center;gap:8px;background:linear-gradient(135deg,#0ea5e9,#0284c7);color:#fff;padding:12px 28px;border-radius:12px;font-weight:700;text-decoration:none;">← Kembali ke Beranda</a>
  </div>

</div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\BioAquaLab\bioaqua\resources\views/pages/kontak.blade.php ENDPATH**/ ?>