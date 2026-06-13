<?php $__env->startSection('title','Detail Pesanan'); ?>
<?php $__env->startSection('content'); ?>

<?php
$statusColors = [
  'menunggu' => ['#d97706','#fef3c7','⏳'],
  'proses'   => ['#2563eb','#dbeafe','🔄'],
  'selesai'  => ['#059669','#d1fae5','✅'],
  'batal'    => ['#dc2626','#fee2e2','❌'],
];
[$sc,$sbg,$sicon] = $statusColors[$pesanan->status] ?? ['#94a3b8','#f8fafc','📦'];
$konfirmasi = $pesanan->konfirmasi_bayar ?? 'menunggu';
$isCod      = ($pesanan->metode_bayar === 'cod');
?>

<div class="show-page">
<div class="show-wrap">

  <div class="show-hero">
    <a href="<?php echo e(route('pesanan.riwayat')); ?>" class="show-back">← Kembali ke Riwayat</a>
    <h1>Detail Pesanan</h1>
    <div class="show-kode"><?php echo e($pesanan->kode_pesanan ?? '#'.$pesanan->id); ?></div>
  </div>

  <div class="show-grid">
    <div class="show-card">
      <div class="show-card-head">📦 Informasi Pesanan</div>
      <div class="info-rows">
        <div class="info-row"><span>Kode</span><strong><?php echo e($pesanan->kode_pesanan ?? '#'.$pesanan->id); ?></strong></div>
        <div class="info-row"><span>Produk</span><span><?php echo e($pesanan->nama_produk); ?></span></div>
        <div class="info-row"><span>Jumlah</span><span><?php echo e($pesanan->jumlah); ?> item</span></div>
        <div class="info-row"><span>Total</span><strong class="total-highlight">Rp <?php echo e(number_format($pesanan->total_harga,0,',','.')); ?></strong></div>
        <div class="info-row"><span>Metode Bayar</span><span class="metode-badge"><?php echo e(strtoupper(str_replace('_',' ',$pesanan->metode_bayar ?? '-'))); ?></span></div>
        <div class="info-row"><span>Tanggal Pesan</span><span><?php echo e(\Carbon\Carbon::parse($pesanan->tanggal_pesan)->format('d M Y')); ?></span></div>
        <div class="info-row"><span>Status</span><span class="s-pill" style="background:<?php echo e($sbg); ?>;color:<?php echo e($sc); ?>;"><?php echo e($sicon); ?> <?php echo e(ucfirst($pesanan->status)); ?></span></div>
      </div>

      
      <?php if(!$isCod): ?>
      <div class="pay-status-section">
        <div class="pay-status-title">💳 Status Pembayaran</div>
        <?php if($konfirmasi === 'dikonfirmasi'): ?>
          <div class="pay-status-badge ok">✅ Pembayaran telah dikonfirmasi oleh admin</div>
        <?php elseif($konfirmasi === 'ditolak'): ?>
          <div class="pay-status-badge reject">❌ Pembayaran ditolak — hubungi admin melalui WhatsApp</div>
        <?php else: ?>
          <div class="pay-status-badge wait">⏳ Menunggu konfirmasi admin</div>
        <?php endif; ?>

        <?php if($pesanan->bukti_bayar): ?>
        <a href="<?php echo e(route('pesanan.bukti', $pesanan)); ?>" target="_blank" class="bukti-view-btn">🖼 Lihat Bukti Pembayaran</a>
        <?php endif; ?>
      </div>
      <?php endif; ?>
    </div>

    <div class="show-card">
      <div class="show-card-head">🚚 Data Pengiriman</div>
      <div class="info-rows">
        <div class="info-row"><span>Nama</span><span><?php echo e($pesanan->nama_pelanggan); ?></span></div>
        <div class="info-row"><span>No. HP</span><span><?php echo e($pesanan->no_hp); ?></span></div>
        <div class="info-row"><span>Jenis</span><span><?php echo e(($pesanan->jenis_pengiriman ?? 'antar') === 'jemput' ? '🏪 Ambil Sendiri' : '🚐 Diantar'); ?></span></div>
        <?php if(($pesanan->jenis_pengiriman ?? 'antar') === 'antar'): ?>
        <?php if($pesanan->kecamatan): ?>
        <div class="info-row">
          <span>Kecamatan</span>
          <span class="addr-tag"><?php echo e($pesanan->kecamatan); ?></span>
        </div>
        <?php endif; ?>
        <?php if($pesanan->kelurahan): ?>
        <div class="info-row">
          <span>Kelurahan / Desa</span>
          <span class="addr-tag"><?php echo e($pesanan->kelurahan); ?></span>
        </div>
        <?php endif; ?>
        <?php if($pesanan->rt_rw): ?>
        <div class="info-row">
          <span>RT / RW</span>
          <span class="addr-tag"><?php echo e($pesanan->rt_rw); ?></span>
        </div>
        <?php endif; ?>
        <div class="info-row"><span>Alamat</span><span><?php echo e($pesanan->alamat); ?></span></div>
        <?php endif; ?>
        <?php if($pesanan->catatan): ?>
        <div class="info-row"><span>Catatan</span><span><?php echo e($pesanan->catatan); ?></span></div>
        <?php endif; ?>
      </div>
    </div>
  </div>

  <div class="show-actions">
    <a href="<?php echo e(route('pesanan.riwayat')); ?>" class="btn-back2">← Riwayat Pesanan</a>
    <a href="/" class="btn-shop2">🛒 Belanja Lagi</a>
  </div>

</div>
</div>

<style>
.show-page { background:transparent; min-height:100vh; padding:28px 16px 48px; font-family:'Inter',system-ui,sans-serif; }
.show-wrap { max-width:800px; margin:0 auto; }

.show-hero { background:linear-gradient(135deg,#1e40af,#2563eb,#3b82f6); border-radius:18px; padding:22px 28px; margin-bottom:22px; color:#fff; box-shadow:0 8px 28px rgba(37,99,235,.35); }
.show-back { display:inline-block; color:rgba(255,255,255,.8); text-decoration:none; font-size:.85rem; font-weight:600; margin-bottom:10px; transition:.2s; }
.show-back:hover { color:#fff; }
.show-hero h1 { font-size:1.5rem; font-weight:800; margin:0 0 8px; }
.show-kode { font-family:monospace; font-size:.9rem; background:rgba(255,255,255,.2); display:inline-block; padding:4px 16px; border-radius:99px; }

.show-grid { display:grid; grid-template-columns:1fr 1fr; gap:16px; margin-bottom:16px; }
@media(max-width:640px){ .show-grid { grid-template-columns:1fr; } }

.show-card { background:#fff; border-radius:16px; padding:22px; box-shadow:0 4px 20px rgba(37,99,235,.08); border:1.5px solid #dbeafe; }
.show-card-head { font-size:.9rem; font-weight:700; color:#1e293b; margin-bottom:16px; padding-bottom:10px; border-bottom:2px solid #dbeafe; }
.info-rows {}
.info-row { display:flex; justify-content:space-between; align-items:flex-start; gap:16px; padding:9px 0; border-bottom:1px solid #f1f5f9; font-size:.85rem; }
.info-row:last-child { border:none; }
.info-row>span:first-child { color:#94a3b8; flex-shrink:0; min-width:90px; font-size:.8rem; }
.total-highlight { font-size:1.1rem; font-weight:900; color:#1e40af; }
.metode-badge { background:#dbeafe; color:#1e40af; font-size:.75rem; font-weight:700; padding:3px 10px; border-radius:99px; }
.s-pill { font-size:.78rem; font-weight:700; padding:4px 12px; border-radius:99px; }
.addr-tag { background:#eff6ff; color:#1e40af; font-size:.78rem; font-weight:700; padding:3px 10px; border-radius:6px; }

/* Payment status */
.pay-status-section { margin-top:16px; padding-top:14px; border-top:1px solid #f1f5f9; }
.pay-status-title { font-size:.8rem; font-weight:700; color:#64748b; margin-bottom:8px; }
.pay-status-badge { font-size:.82rem; font-weight:600; padding:8px 14px; border-radius:10px; display:inline-block; }
.pay-status-badge.ok     { background:#d1fae5; color:#065f46; }
.pay-status-badge.reject { background:#fee2e2; color:#991b1b; }
.pay-status-badge.wait   { background:#fef3c7; color:#92400e; }
.bukti-view-btn { display:inline-flex; align-items:center; gap:6px; background:linear-gradient(135deg,#1e40af,#2563eb); color:#fff; padding:8px 16px; border-radius:8px; font-size:.8rem; font-weight:700; text-decoration:none; margin-top:10px; transition:.2s; }
.bukti-view-btn:hover { opacity:.88; }

.show-actions { display:flex; gap:12px; justify-content:flex-end; margin-top:4px; }
.btn-back2 { padding:11px 20px; border:2px solid #dbeafe; border-radius:12px; text-decoration:none; font-size:.88rem; font-weight:600; color:#2563eb; background:#fff; transition:.2s; }
.btn-back2:hover { background:#eff6ff; }
.btn-shop2 { padding:11px 22px; background:linear-gradient(135deg,#1e40af,#2563eb); color:#fff; border-radius:12px; text-decoration:none; font-size:.88rem; font-weight:700; transition:.2s; }
.btn-shop2:hover { opacity:.9; transform:translateY(-1px); }

/* ===== DARK MODE OVERRIDES ===== */
html.dark-mode .show-card { background:#16213e !important; border-color:#334155 !important; }
html.dark-mode .show-card-head { color:#f1f5f9 !important; border-color:#334155 !important; }
html.dark-mode .info-row { color:#e2e8f0 !important; }
html.dark-mode .info-row>span:first-child { color:#94a3b8 !important; }
html.dark-mode .total-highlight { color:#7dd3fc !important; }
html.dark-mode .metode-badge,
html.dark-mode .addr-tag { background:#1e3a5f !important; color:#7dd3fc !important; }
html.dark-mode .pay-status-title { color:#94a3b8 !important; }
html.dark-mode .btn-back2 { background:#16213e !important; border-color:#334155 !important; color:#7dd3fc !important; }
html.dark-mode .btn-back2:hover { background:#1e2d45 !important; }
html.dark-mode .pay-status-badge.ok     { background:#14532d !important; color:#bbf7d0 !important; }
html.dark-mode .pay-status-badge.reject { background:#7f1d1d !important; color:#fecaca !important; }
html.dark-mode .pay-status-badge.wait   { background:#78350f !important; color:#fcd34d !important; }
</style>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\BioAquaLab\BioAquaLab\resources\views/pesanan/show.blade.php ENDPATH**/ ?>