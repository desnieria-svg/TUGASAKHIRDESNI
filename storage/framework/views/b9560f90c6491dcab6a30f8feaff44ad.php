<?php $__env->startSection('title','Riwayat Pesanan'); ?>
<?php $__env->startSection('content'); ?>

<div class="rw-page">
<div class="rw-wrap">

  <div class="rw-hero">
    <div>
      <h1>📋 Riwayat Pesanan</h1>
      <p>Semua pesanan yang pernah kamu buat</p>
    </div>
    <a href="/" class="rw-back">🛒 Lanjut Belanja</a>
  </div>

  <?php if($pesanans->isEmpty()): ?>
  <div class="rw-empty">
    <div style="font-size:3rem;margin-bottom:12px;">📭</div>
    <h3>Belum ada pesanan</h3>
    <p>Kamu belum pernah memesan. Yuk belanja sekarang!</p>
    <a href="/" class="btn-shop">🛒 Mulai Belanja</a>
  </div>
  <?php else: ?>
  <div class="rw-list">
    <?php $__currentLoopData = $pesanans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <?php
      $statusColors = [
        'menunggu' => ['#d97706','#fef3c7','⏳'],
        'proses'   => ['#2563eb','#dbeafe','🔄'],
        'selesai'  => ['#059669','#d1fae5','✅'],
        'batal'    => ['#dc2626','#fee2e2','❌'],
      ];
      [$sc,$sbg,$sicon] = $statusColors[$p->status] ?? ['#94a3b8','#f1f5f9','📦'];
      $isCod = ($p->metode_bayar === 'cod');
      $konfirmasi = $p->konfirmasi_bayar ?? 'menunggu';
    ?>
    <div class="rw-card">
      <div class="rw-card-top">
        <div class="rw-card-left">
          <span class="rw-kode"><?php echo e($p->kode_pesanan ?? '#'.$p->id); ?></span>
          <span class="rw-tgl"><?php echo e(\Carbon\Carbon::parse($p->tanggal_pesan)->format('d M Y')); ?></span>
        </div>
        <span class="rw-status" style="background:<?php echo e($sbg); ?>;color:<?php echo e($sc); ?>;"><?php echo e($sicon); ?> <?php echo e(ucfirst($p->status)); ?></span>
      </div>

      <div class="rw-card-body">
        <div class="rw-info-grid">
          <div class="rw-info-item">
            <span class="rw-info-label">Produk</span>
            <span class="rw-info-val"><?php echo e($p->nama_produk); ?></span>
          </div>
          <div class="rw-info-item">
            <span class="rw-info-label">Total</span>
            <span class="rw-info-val rw-total">Rp <?php echo e(number_format($p->total_harga,0,',','.')); ?></span>
          </div>
          <div class="rw-info-item">
            <span class="rw-info-label">Metode Bayar</span>
            <span class="rw-info-val"><span class="rw-metode"><?php echo e(strtoupper(str_replace('_',' ',$p->metode_bayar ?? '-'))); ?></span></span>
          </div>
          <div class="rw-info-item">
            <span class="rw-info-label">Pengiriman</span>
            <span class="rw-info-val"><?php echo e(($p->jenis_pengiriman ?? 'antar') === 'jemput' ? '🏪 Jemput Sendiri' : '🚐 Diantar'); ?></span>
          </div>
          <?php if(($p->jenis_pengiriman ?? 'antar') === 'antar'): ?>
          <div class="rw-info-item rw-full">
            <span class="rw-info-label">📍 Alamat Pengiriman</span>
            <span class="rw-info-val">
              <?php if($p->kecamatan || $p->kelurahan): ?>
                <span class="rw-addr-tag">Kec. <?php echo e($p->kecamatan); ?></span>
                <span class="rw-addr-tag">Kel. <?php echo e($p->kelurahan); ?></span>
                <?php if($p->rt_rw): ?><span class="rw-addr-tag">RT/RW <?php echo e($p->rt_rw); ?></span><?php endif; ?>
                <br><span style="color:#475569;font-size:.82rem;"><?php echo e($p->alamat); ?></span>
              <?php else: ?>
                <?php echo e($p->alamat); ?>

              <?php endif; ?>
            </span>
          </div>
          <?php endif; ?>
        </div>

        
        <?php if(!$isCod): ?>
        <div class="rw-payment-status">
          <?php if($konfirmasi === 'dikonfirmasi'): ?>
            <span class="pay-badge pay-ok">✅ Pembayaran Dikonfirmasi Admin</span>
          <?php elseif($konfirmasi === 'ditolak'): ?>
            <span class="pay-badge pay-reject">❌ Pembayaran Ditolak — Hubungi Admin</span>
          <?php else: ?>
            <span class="pay-badge pay-wait">⏳ Menunggu Konfirmasi Pembayaran Admin</span>
          <?php endif; ?>
        </div>
        <?php endif; ?>
      </div>

      <div class="rw-card-foot">
        <a href="<?php echo e(route('pesanan.show',$p)); ?>" class="rw-detail-btn">Lihat Detail →</a>
      </div>
    </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
  </div>

  <?php if($pesanans->hasPages()): ?>
  <div class="rw-pager"><?php echo e($pesanans->links()); ?></div>
  <?php endif; ?>
  <?php endif; ?>

</div>
</div>

<style>
.rw-page { background:transparent; min-height:100vh; padding:28px 16px 48px; font-family:'Inter',system-ui,sans-serif; }
.rw-wrap { max-width:900px; margin:0 auto; }

.rw-hero { display:flex; justify-content:space-between; align-items:center; background:linear-gradient(135deg,#1e40af,#2563eb,#3b82f6); border-radius:18px; padding:22px 28px; margin-bottom:22px; color:#fff; box-shadow:0 8px 28px rgba(37,99,235,.35); }
.rw-hero h1 { font-size:1.5rem; font-weight:800; margin:0 0 4px; }
.rw-hero p  { opacity:.75; font-size:.88rem; margin:0; }
.rw-back { background:rgba(255,255,255,.15); border:1px solid rgba(255,255,255,.3); color:#fff; padding:9px 18px; border-radius:10px; text-decoration:none; font-size:.85rem; font-weight:600; transition:.2s; white-space:nowrap; }
.rw-back:hover { background:rgba(255,255,255,.25); }

.rw-empty { background:#fff; border-radius:20px; padding:48px; text-align:center; box-shadow:0 8px 32px rgba(37,99,235,.1); border:1px solid #dbeafe; }
.rw-empty h3 { font-size:1.2rem; font-weight:700; color:#1e293b; margin:0 0 8px; }
.rw-empty p  { color:#94a3b8; margin:0 0 20px; }
.btn-shop { display:inline-block; background:linear-gradient(135deg,#1e40af,#2563eb); color:#fff; padding:12px 28px; border-radius:12px; font-weight:700; text-decoration:none; }

.rw-list { display:flex; flex-direction:column; gap:14px; }

.rw-card { background:#fff; border-radius:18px; box-shadow:0 4px 20px rgba(37,99,235,.08); border:1px solid #dbeafe; overflow:hidden; transition:.2s; }
.rw-card:hover { box-shadow:0 8px 28px rgba(37,99,235,.14); transform:translateY(-2px); }

.rw-card-top { display:flex; justify-content:space-between; align-items:center; padding:14px 20px; background:linear-gradient(135deg,#f0f7ff,#eff6ff); border-bottom:1px solid #dbeafe; }
.rw-card-left { display:flex; align-items:center; gap:10px; }
.rw-kode { font-family:monospace; font-weight:700; font-size:.82rem; color:#1e40af; background:#dbeafe; padding:3px 10px; border-radius:6px; }
.rw-tgl { font-size:.78rem; color:#64748b; }
.rw-status { font-size:.75rem; font-weight:700; padding:4px 12px; border-radius:99px; white-space:nowrap; }

.rw-card-body { padding:16px 20px; }
.rw-info-grid { display:grid; grid-template-columns:1fr 1fr; gap:10px 20px; }
.rw-full { grid-column:1/-1; }
.rw-info-item { display:flex; flex-direction:column; gap:2px; }
.rw-info-label { font-size:.72rem; font-weight:600; color:#94a3b8; text-transform:uppercase; letter-spacing:.04em; }
.rw-info-val { font-size:.85rem; font-weight:600; color:#1e293b; }
.rw-total { color:#1e40af; font-weight:800; font-size:.92rem; }
.rw-metode { font-size:.72rem; background:#dbeafe; color:#1e40af; padding:2px 8px; border-radius:99px; font-weight:700; }
.rw-addr-tag { display:inline-block; background:#eff6ff; color:#1e40af; font-size:.72rem; font-weight:700; padding:2px 8px; border-radius:6px; margin:2px 2px 4px 0; }

.rw-payment-status { margin-top:12px; }
.pay-badge { display:inline-flex; align-items:center; gap:5px; font-size:.78rem; font-weight:600; padding:6px 14px; border-radius:99px; }
.pay-ok     { background:#d1fae5; color:#065f46; }
.pay-reject { background:#fee2e2; color:#991b1b; }
.pay-wait   { background:#fef3c7; color:#92400e; }

.rw-card-foot { padding:12px 20px; border-top:1px solid #f1f5f9; display:flex; justify-content:flex-end; }
.rw-detail-btn { display:inline-flex; align-items:center; gap:6px; background:linear-gradient(135deg,#1e40af,#2563eb); color:#fff; padding:8px 18px; border-radius:8px; text-decoration:none; font-size:.8rem; font-weight:700; transition:.2s; }
.rw-detail-btn:hover { opacity:.88; transform:translateY(-1px); }

.rw-pager { margin-top:20px; background:#fff; border-radius:12px; padding:12px 16px; border:1px solid #dbeafe; }

@media(max-width:600px){
  .rw-info-grid { grid-template-columns:1fr; }
  .rw-full { grid-column:1; }
}
</style>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\BioAquaLab\bioaqua\resources\views/pesanan/riwayat.blade.php ENDPATH**/ ?>