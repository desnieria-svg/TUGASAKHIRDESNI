<?php $__env->startSection('title','Admin — Kelola Pesanan'); ?>
<?php $__env->startSection('content'); ?>

<div class="adm-page">
<div class="adm-wrap">

  
  <div class="adm-hero">
    <div>
      <div class="adm-badge">⚙️ Admin Panel</div>
      <h1 class="adm-title">Kelola Pesanan</h1>
      <p class="adm-sub">Pantau & perbarui status semua pesanan pelanggan</p>
    </div>
    <a href="<?php echo e(route('dashboard')); ?>" class="adm-back-btn">← Dashboard</a>
  </div>

  <?php if(session('success')): ?>
  <div class="flash-ok">✅ <?php echo e(session('success')); ?></div>
  <?php endif; ?>
  <?php if(session('error')): ?>
  <div class="flash-err">❌ <?php echo e(session('error')); ?></div>
  <?php endif; ?>

  
  <?php
    $all        = \App\Models\Pesanan::count();
    $tunggu     = \App\Models\Pesanan::menunggu()->count();
    $proses     = \App\Models\Pesanan::proses()->count();
    $selesai    = \App\Models\Pesanan::selesai()->count();
    $batal      = \App\Models\Pesanan::batal()->count();
    $pendapatan = \App\Models\Pesanan::selesai()->sum('total_harga');
    $buktiWaiting = \App\Models\Pesanan::where('konfirmasi_bayar','menunggu')->whereNotNull('bukti_bayar')->count();
  ?>

  <div class="stats-grid">
    <div class="stat-card" style="--accent:#2563eb">
      <div class="stat-icon">📋</div>
      <div class="stat-val"><?php echo e($all); ?></div>
      <div class="stat-lbl">Total Pesanan</div>
    </div>
    <div class="stat-card" style="--accent:#d97706">
      <div class="stat-icon">⏳</div>
      <div class="stat-val"><?php echo e($tunggu); ?></div>
      <div class="stat-lbl">Menunggu</div>
    </div>
    <div class="stat-card" style="--accent:#7c3aed">
      <div class="stat-icon">🔄</div>
      <div class="stat-val"><?php echo e($proses); ?></div>
      <div class="stat-lbl">Diproses</div>
    </div>
    <div class="stat-card" style="--accent:#059669">
      <div class="stat-icon">✅</div>
      <div class="stat-val"><?php echo e($selesai); ?></div>
      <div class="stat-lbl">Selesai</div>
    </div>
    <div class="stat-card" style="--accent:#dc2626">
      <div class="stat-icon">❌</div>
      <div class="stat-val"><?php echo e($batal); ?></div>
      <div class="stat-lbl">Dibatal</div>
    </div>
    <div class="stat-card income-card" style="--accent:#1e40af">
      <div class="stat-icon">💰</div>
      <div class="stat-val stat-income">Rp&nbsp;<?php echo e(number_format($pendapatan,0,',','.')); ?></div>
      <div class="stat-lbl">Total Pendapatan</div>
    </div>
  </div>

  
  <div class="chart-card">
    <div class="chart-head">
      <h3>📈 Grafik Penjualan (14 Hari Terakhir)</h3>
      <span class="chart-sub">Total pendapatan dari pesanan berstatus selesai</span>
    </div>
    <div class="chart-wrap">
      <canvas id="salesChart"></canvas>
    </div>
  </div>

  
  <?php if($buktiWaiting > 0): ?>
  <div class="alert-bukti">
    <span class="alert-bukti-icon">🔔</span>
    <div>
      <strong><?php echo e($buktiWaiting); ?> pesanan</strong> menunggu konfirmasi bukti pembayaran!
      Segera cek dan konfirmasi pembayaran pelanggan.
    </div>
  </div>
  <?php endif; ?>

  
  <div class="filter-bar">
    <div class="filter-tabs" id="filterTabs">
      <button class="ftab active" data-filter="all">Semua</button>
      <button class="ftab" data-filter="menunggu">⏳ Menunggu</button>
      <button class="ftab" data-filter="proses">🔄 Diproses</button>
      <button class="ftab" data-filter="selesai">✅ Selesai</button>
      <button class="ftab" data-filter="batal">❌ Batal</button>
    </div>
    <input type="text" id="searchInp" placeholder="🔍 Cari nama / kode..." class="search-inp">
  </div>

  <form method="GET" action="<?php echo e(route('admin.pesanan')); ?>" class="date-filter-bar">
    <div class="date-filter-group">
      <label>📅 Dari Tanggal</label>
      <input type="date" name="dari" value="<?php echo e(request('dari')); ?>" class="date-inp">
    </div>
    <div class="date-filter-group">
      <label>📅 Sampai Tanggal</label>
      <input type="date" name="sampai" value="<?php echo e(request('sampai')); ?>" class="date-inp">
    </div>
    <button type="submit" class="date-filter-btn">Terapkan</button>
    <?php if(request('dari') || request('sampai')): ?>
    <a href="<?php echo e(route('admin.pesanan')); ?>" class="date-filter-reset">✕ Reset</a>
    <?php endif; ?>
  </form>

  
  <div class="tbl-card">
    <div class="tbl-scroll">
    <table class="adm-tbl" id="pesananTbl">
      <thead>
        <tr>
          <th>Kode</th>
          <th>Pelanggan</th>
          <th>Produk</th>
          <th>Pengiriman</th>
          <th>Total</th>
          <th>Metode & Bukti</th>
          <th>Tanggal</th>
          <th>Status</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php $__empty_1 = true; $__currentLoopData = $pesanans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <?php
          $statusColors = [
            'menunggu' => ['#d97706','#fef3c7'],
            'proses'   => ['#2563eb','#dbeafe'],
            'selesai'  => ['#059669','#d1fae5'],
            'batal'    => ['#dc2626','#fee2e2'],
          ];
          [$sc,$sbg] = $statusColors[$p->status] ?? ['#94a3b8','#f1f5f9'];
          $jenisIcon = ($p->jenis_pengiriman ?? 'antar') === 'jemput' ? '🏪 Jemput' : '🚐 Antar';
          $konfirmasi = $p->konfirmasi_bayar ?? 'menunggu';
          $isCod = ($p->metode_bayar === 'cod');
        ?>
        <tr data-status="<?php echo e($p->status); ?>" data-search="<?php echo e(strtolower($p->nama_pelanggan.' '.($p->kode_pesanan ?? ''))); ?>">
          <td>
            <span class="kode-pill"><?php echo e($p->kode_pesanan ?? '#'.$p->id); ?></span>
          </td>
          <td>
            <div class="pel-name"><?php echo e($p->nama_pelanggan); ?></div>
            <div class="pel-hp"><?php echo e($p->no_hp ?? '-'); ?></div>
          </td>
          <td class="prod-cell" title="<?php echo e($p->nama_produk); ?>"><?php echo e($p->nama_produk); ?></td>
          <td>
            <span class="jenis-badge <?php echo e(($p->jenis_pengiriman??'antar') === 'jemput' ? 'badge-jemput' : 'badge-antar'); ?>"><?php echo e($jenisIcon); ?></span>
            <?php if(($p->jenis_pengiriman??'antar') === 'antar' && ($p->kecamatan || $p->kelurahan)): ?>
            <div class="addr-mini">Kec. <?php echo e($p->kecamatan); ?>, <?php echo e($p->kelurahan); ?><?php if($p->rt_rw): ?>, RT/RW <?php echo e($p->rt_rw); ?><?php endif; ?></div>
            <?php endif; ?>
          </td>
          <td><span class="total-txt">Rp <?php echo e(number_format($p->total_harga,0,',','.')); ?></span></td>
          <td>
            <div class="metode-cell">
              <span class="metode-txt"><?php echo e(strtoupper(str_replace('_',' ',$p->metode_bayar ?? '-'))); ?></span>
              <?php if(!$isCod): ?>
                <?php if($p->bukti_bayar): ?>
                  <a href="<?php echo e(route('pesanan.bukti', $p)); ?>" target="_blank" class="bukti-link">🖼 Lihat Bukti</a>
                  <?php if($konfirmasi === 'menunggu'): ?>
                  <div class="konfirmasi-actions">
                    <form action="<?php echo e(route('admin.pesanan.konfirmasi',$p)); ?>" method="POST" style="display:inline">
                      <?php echo csrf_field(); ?> <?php echo method_field('PATCH'); ?>
                      <input type="hidden" name="konfirmasi_bayar" value="dikonfirmasi">
                      <button type="submit" class="btn-konfirm ok">✓ Konfirmasi</button>
                    </form>
                    <form action="<?php echo e(route('admin.pesanan.konfirmasi',$p)); ?>" method="POST" style="display:inline">
                      <?php echo csrf_field(); ?> <?php echo method_field('PATCH'); ?>
                      <input type="hidden" name="konfirmasi_bayar" value="ditolak">
                      <button type="submit" class="btn-konfirm reject">✗ Tolak</button>
                    </form>
                  </div>
                  <?php elseif($konfirmasi === 'dikonfirmasi'): ?>
                  <span class="konfirm-badge ok">✅ Dikonfirmasi</span>
                  <?php else: ?>
                  <span class="konfirm-badge reject">❌ Ditolak</span>
                  <?php endif; ?>
                <?php else: ?>
                  <span class="bukti-missing">⏳ Belum ada bukti</span>
                <?php endif; ?>
              <?php else: ?>
                <span class="konfirm-badge ok">💵 COD</span>
              <?php endif; ?>
            </div>
          </td>
          <td class="tgl-txt"><?php echo e(\Carbon\Carbon::parse($p->tanggal_pesan)->format('d/m/Y')); ?></td>
          <td>
            <span class="status-pill" style="background:<?php echo e($sbg); ?>;color:<?php echo e($sc); ?>;"><?php echo e(ucfirst($p->status)); ?></span>
          </td>
          <td>
            <?php if(in_array($p->status, ['selesai','batal'])): ?>
              <span class="locked-status">
                <svg viewBox="0 0 24 24" fill="none" width="13" height="13"><rect x="4" y="10" width="16" height="10" rx="2" stroke="currentColor" stroke-width="1.8"/><path d="M8 10V7a4 4 0 0 1 8 0v3" stroke="currentColor" stroke-width="1.8"/></svg>
                Terkunci
              </span>
            <?php else: ?>
            <form action="<?php echo e(route('admin.pesanan.status',$p)); ?>" method="POST" class="status-form">
              <?php echo csrf_field(); ?> <?php echo method_field('PATCH'); ?>
              <select name="status" class="status-sel">
                <?php $__currentLoopData = ['menunggu','proses','selesai','batal']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($s); ?>" <?php echo e($p->status===$s?'selected':''); ?>><?php echo e(ucfirst($s)); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </select>
              <button type="submit" class="status-btn">✓ Simpan</button>
            </form>
            <?php endif; ?>
          </td>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <tr><td colspan="9" class="empty-row">Belum ada pesanan masuk.</td></tr>
        <?php endif; ?>
      </tbody>
    </table>
    </div>
    <?php if($pesanans->hasPages()): ?>
    <div class="pager"><?php echo e($pesanans->links()); ?></div>
    <?php endif; ?>
  </div>

</div>
</div>

<style>
/* ===== BASE ===== */
.adm-page { background:transparent; min-height:100vh; padding:28px 16px 48px; font-family:'Inter',system-ui,sans-serif; }
.adm-wrap { max-width:1350px; margin:0 auto; }

/* ===== HERO ===== */
.adm-hero { display:flex; justify-content:space-between; align-items:flex-start; background:linear-gradient(135deg,#1e40af,#2563eb,#3b82f6); border-radius:20px; padding:28px 32px; margin-bottom:24px; box-shadow:0 8px 28px rgba(37,99,235,.35); }
.adm-badge { display:inline-block; background:rgba(255,255,255,.2); border:1px solid rgba(255,255,255,.35); color:#fff; padding:4px 14px; border-radius:99px; font-size:.78rem; font-weight:700; margin-bottom:10px; }
.adm-title { font-size:1.8rem; font-weight:800; color:#fff; margin:0 0 6px; line-height:1.2; }
.adm-sub   { color:rgba(255,255,255,.85); font-size:.9rem; margin:0; }
.adm-back-btn { display:inline-flex; align-items:center; background:rgba(255,255,255,.18); border:1px solid rgba(255,255,255,.35); color:#fff; padding:10px 18px; border-radius:10px; text-decoration:none; font-size:.85rem; font-weight:600; transition:.2s; white-space:nowrap; }
.adm-back-btn:hover { background:rgba(255,255,255,.3); }

/* ===== STATS ===== */
.stats-grid { display:grid; grid-template-columns:repeat(6,1fr); gap:14px; margin-bottom:24px; }
.stat-card { background:#fff; border:2px solid #dbeafe; border-radius:16px; padding:18px 12px; text-align:center; transition:.2s; box-shadow:0 4px 16px rgba(37,99,235,.07); position:relative; overflow:hidden; min-width:0; }
.stat-card::before { content:''; position:absolute; top:0; left:0; right:0; height:3px; background:var(--accent,#2563eb); }
.stat-card:hover { transform:translateY(-3px); box-shadow:0 8px 28px rgba(37,99,235,.14); }
.stat-icon { font-size:1.4rem; margin-bottom:6px; }
.stat-val  { font-size:1.5rem; font-weight:900; color:#0f172a; margin-bottom:4px; line-height:1.1; font-family:'Inter',system-ui,sans-serif; }
.stat-lbl  { font-size:.7rem; color:#64748b; font-weight:600; letter-spacing:.02em; white-space:nowrap; }
.stat-income { font-size:1rem; font-weight:900; color:#1e40af; word-break:break-word; line-height:1.25; font-family:'Inter',system-ui,sans-serif; letter-spacing:-0.01em; white-space:nowrap; }
.income-card .stat-val { font-size:1rem; }

@media(max-width:1100px){
  .stats-grid { grid-template-columns:repeat(3,1fr); }
}
@media(max-width:600px){
  .stats-grid { grid-template-columns:repeat(2,1fr); }
  .stat-income, .income-card .stat-val { font-size:.85rem; white-space:normal; }
}

/* ===== ALERT BUKTI ===== */
.alert-bukti { display:flex; align-items:center; gap:12px; background:linear-gradient(135deg,#fef3c7,#fde68a); border:2px solid #f59e0b; border-radius:14px; padding:14px 20px; margin-bottom:20px; font-size:.875rem; font-weight:600; color:#92400e; }
.alert-bukti-icon { font-size:1.4rem; flex-shrink:0; }

/* ===== FILTER ===== */
.filter-bar { display:flex; justify-content:space-between; align-items:center; gap:14px; margin-bottom:16px; flex-wrap:wrap; }
.filter-tabs { display:flex; gap:8px; flex-wrap:wrap; }
.ftab { padding:8px 16px; border:1.5px solid #dbeafe; background:#fff; color:#64748b; border-radius:99px; font-size:.8rem; font-weight:600; cursor:pointer; transition:.2s; font-family:inherit; }
.ftab.active { background:linear-gradient(135deg,#1e40af,#2563eb); border-color:transparent; color:#fff; box-shadow:0 4px 12px rgba(37,99,235,.3); }
.ftab:hover:not(.active) { background:#eff6ff; border-color:#93c5fd; }
.search-inp { padding:9px 16px; border:1.5px solid #dbeafe; background:#fff; border-radius:12px; color:#0f172a; font-size:.85rem; outline:none; min-width:220px; font-family:inherit; }
.search-inp:focus { border-color:#2563eb; }

/* ===== TABLE ===== */
.tbl-card { background:#fff; border:1.5px solid #dbeafe; border-radius:20px; overflow:hidden; box-shadow:0 4px 20px rgba(37,99,235,.08); }
.tbl-scroll { overflow-x:auto; }
.adm-tbl { width:100%; border-collapse:collapse; }
.adm-tbl thead tr { background:linear-gradient(135deg,#1e40af,#2563eb); }
.adm-tbl th { padding:14px 14px; font-size:.77rem; font-weight:700; color:#fff; text-align:left; white-space:nowrap; letter-spacing:.03em; }
.adm-tbl tbody tr { border-bottom:1px solid #f1f5f9; transition:.15s; }
.adm-tbl tbody tr:hover { background:#f0f7ff; }
.adm-tbl td { padding:12px 14px; vertical-align:top; }
.adm-tbl tr.row-hidden { display:none; }

/* ===== CELLS ===== */
.kode-pill { font-family:monospace; font-size:.82rem; font-weight:700; color:#1e40af; background:#dbeafe; padding:3px 10px; border-radius:6px; white-space:nowrap; }
.pel-name  { font-size:.87rem; font-weight:600; color:#0f172a; }
.pel-hp    { font-size:.72rem; color:#94a3b8; margin-top:2px; }
.prod-cell { font-size:.82rem; color:#475569; max-width:140px; overflow:hidden; text-overflow:ellipsis; white-space:nowrap; }
.jenis-badge { font-size:.72rem; font-weight:700; padding:3px 10px; border-radius:99px; display:inline-block; }
.badge-antar  { background:#dcfce7; color:#15803d; }
.badge-jemput { background:#fef3c7; color:#b45309; }
.addr-mini { font-size:.68rem; color:#64748b; margin-top:4px; max-width:140px; line-height:1.4; }
.total-txt  { font-size:.88rem; font-weight:800; color:#1e40af; white-space:nowrap; }
.metode-cell { display:flex; flex-direction:column; gap:5px; }
.metode-txt { font-size:.72rem; color:#1e40af; font-weight:700; background:#dbeafe; padding:2px 8px; border-radius:6px; display:inline-block; white-space:nowrap; }
.tgl-txt    { font-size:.78rem; color:#94a3b8; white-space:nowrap; }
.status-pill { font-size:.75rem; font-weight:700; padding:4px 12px; border-radius:99px; white-space:nowrap; }
.empty-row  { text-align:center; padding:50px; color:#cbd5e1; font-style:italic; }

/* ===== BUKTI / KONFIRMASI ===== */
.bukti-link { font-size:.72rem; color:#2563eb; font-weight:600; text-decoration:none; background:#eff6ff; padding:3px 8px; border-radius:6px; display:inline-block; }
.bukti-link:hover { background:#dbeafe; }
.bukti-missing { font-size:.7rem; color:#94a3b8; font-style:italic; }
.konfirmasi-actions { display:flex; gap:4px; flex-wrap:wrap; margin-top:4px; }
.btn-konfirm { font-size:.7rem; font-weight:700; padding:4px 10px; border-radius:6px; border:none; cursor:pointer; font-family:inherit; transition:.15s; white-space:nowrap; }
.btn-konfirm.ok { background:#d1fae5; color:#065f46; }
.btn-konfirm.ok:hover { background:#a7f3d0; }
.btn-konfirm.reject { background:#fee2e2; color:#991b1b; }
.btn-konfirm.reject:hover { background:#fecaca; }
.konfirm-badge { font-size:.7rem; font-weight:700; padding:3px 8px; border-radius:6px; display:inline-block; }
.konfirm-badge.ok { background:#d1fae5; color:#065f46; }
.konfirm-badge.reject { background:#fee2e2; color:#991b1b; }

/* ===== STATUS FORM ===== */
.status-form { display:flex; gap:6px; align-items:center; flex-wrap:nowrap; }
.status-sel  { font-size:.77rem; padding:6px 8px; border:1.5px solid #dbeafe; background:#f8faff; border-radius:8px; color:#0f172a; cursor:pointer; outline:none; font-family:inherit; }
.status-btn  { padding:6px 10px; background:linear-gradient(135deg,#1e40af,#2563eb); color:#fff; border:none; border-radius:8px; font-size:.77rem; font-weight:700; cursor:pointer; white-space:nowrap; transition:.15s; font-family:inherit; }
.status-btn:hover { opacity:.85; }
.locked-status { display:inline-flex; align-items:center; gap:5px; font-size:.73rem; color:#94a3b8; font-weight:600; }

/* ===== PAGER / FLASH ===== */
.pager { padding:14px 20px; border-top:1px solid #f1f5f9; }
.flash-ok  { background:#dcfce7; border:1px solid #86efac; border-radius:12px; padding:12px 18px; margin-bottom:18px; color:#15803d; font-size:.875rem; font-weight:600; }
.flash-err { background:#fee2e2; border:1px solid #fca5a5; border-radius:12px; padding:12px 18px; margin-bottom:18px; color:#991b1b; font-size:.875rem; font-weight:600; }

/* ===== CHART ===== */
.chart-card { background:#fff; border:1.5px solid #dbeafe; border-radius:20px; padding:24px; margin-bottom:20px; box-shadow:0 4px 16px rgba(37,99,235,.07); }
.chart-head { display:flex; justify-content:space-between; align-items:baseline; flex-wrap:wrap; gap:6px; margin-bottom:16px; }
.chart-head h3 { color:#0f172a; font-size:1.05rem; font-weight:800; margin:0; }
.chart-sub { color:#64748b; font-size:.78rem; }
.chart-wrap { position:relative; height:260px; }

/* ===== DATE FILTER ===== */
.date-filter-bar { display:flex; gap:14px; align-items:flex-end; flex-wrap:wrap; margin-bottom:16px; background:#fff; border:1.5px solid #dbeafe; border-radius:14px; padding:14px 18px; box-shadow:0 4px 16px rgba(37,99,235,.06); }
.date-filter-group { display:flex; flex-direction:column; gap:5px; }
.date-filter-group label { color:#64748b; font-size:.75rem; font-weight:600; }
.date-inp { padding:8px 12px; border:1.5px solid #dbeafe; background:#f8faff; border-radius:10px; color:#0f172a; font-size:.82rem; outline:none; font-family:inherit; }
.date-inp:focus { border-color:#2563eb; }
.date-filter-btn { padding:9px 20px; background:linear-gradient(135deg,#1e40af,#2563eb); color:#fff; border:none; border-radius:10px; font-size:.82rem; font-weight:700; cursor:pointer; transition:.15s; font-family:inherit; }
.date-filter-btn:hover { opacity:.85; }
.date-filter-reset { padding:9px 16px; background:#f1f5f9; border:1.5px solid #e2e8f0; color:#64748b; border-radius:10px; font-size:.82rem; font-weight:600; text-decoration:none; transition:.15s; }
.date-filter-reset:hover { background:#e2e8f0; }

/* ===== DARK MODE OVERRIDES ===== */
html.dark-mode .stat-card,
html.dark-mode .tbl-card,
html.dark-mode .chart-card,
html.dark-mode .date-filter-bar,
html.dark-mode .ftab { background:#16213e !important; border-color:#334155 !important; }
html.dark-mode .stat-val,
html.dark-mode .pel-name,
html.dark-mode .chart-head h3,
html.dark-mode .search-inp,
html.dark-mode .date-inp { color:#f1f5f9 !important; }
html.dark-mode .status-sel {
  color:#f1f5f9 !important;
  background:#0f172a !important;
  border-color:#334155 !important;
}
html.dark-mode .status-sel option { color:#0f172a; background:#fff; }
html.dark-mode .stat-lbl,
html.dark-mode .pel-hp,
html.dark-mode .prod-cell,
html.dark-mode .addr-mini,
html.dark-mode .tgl-txt,
html.dark-mode .chart-sub,
html.dark-mode .bukti-missing,
html.dark-mode .locked-status,
html.dark-mode .date-filter-group label,
html.dark-mode .empty-row { color:#94a3b8 !important; }
html.dark-mode .stat-income { color:#7dd3fc !important; }
html.dark-mode .kode-pill { background:#1e3a5f !important; color:#7dd3fc !important; }
html.dark-mode .total-txt { color:#7dd3fc !important; }
html.dark-mode .metode-txt { background:#1e3a5f !important; color:#7dd3fc !important; }
html.dark-mode .search-inp,
html.dark-mode .date-inp { background:#0f172a !important; border-color:#334155 !important; }
html.dark-mode .ftab { color:#94a3b8 !important; }
html.dark-mode .ftab.active { color:#fff !important; }
html.dark-mode .ftab:hover:not(.active) { background:#1e3a5f !important; border-color:#475569 !important; }
html.dark-mode .adm-tbl tbody tr { border-color:#334155 !important; }
html.dark-mode .adm-tbl tbody tr:hover { background:#1e2d45 !important; }
html.dark-mode .date-filter-reset { background:#0f172a !important; border-color:#334155 !important; color:#94a3b8 !important; }
html.dark-mode .date-filter-reset:hover { background:#1e2d45 !important; }
html.dark-mode .bukti-link { background:#1e3a5f !important; color:#7dd3fc !important; }
html.dark-mode .bukti-link:hover { background:#26456f !important; }
html.dark-mode .flash-ok { background:#14532d !important; color:#bbf7d0 !important; border-color:#166534 !important; }
html.dark-mode .flash-err { background:#7f1d1d !important; color:#fecaca !important; border-color:#991b1b !important; }
html.dark-mode .pager { border-color:#334155 !important; }
html.dark-mode .konfirm-badge.ok { background:#14532d !important; color:#bbf7d0 !important; }
html.dark-mode .konfirm-badge.reject { background:#7f1d1d !important; color:#fecaca !important; }
html.dark-mode .jenis-badge.badge-antar { background:#14532d !important; color:#86efac !important; }
html.dark-mode .jenis-badge.badge-jemput { background:#78350f !important; color:#fde68a !important; }

html.dark-mode .status-pill {
  background:rgba(255,255,255,.08) !important;
  filter:none !important;
}
html.dark-mode .status-pill[style*="2563eb"],
html.dark-mode .status-pill[style*="dbeafe"] { color:#93c5fd !important; background:#1e3a5f !important; }
html.dark-mode .status-pill[style*="d97706"],
html.dark-mode .status-pill[style*="fef3c7"] { color:#fcd34d !important; background:#78350f !important; }
html.dark-mode .status-pill[style*="059669"],
html.dark-mode .status-pill[style*="d1fae5"] { color:#86efac !important; background:#14532d !important; }
html.dark-mode .status-pill[style*="dc2626"],
html.dark-mode .status-pill[style*="fee2e2"] { color:#fca5a5 !important; background:#7f1d1d !important; }
html.dark-mode .kode-pill { background:#1e3a5f !important; color:#7dd3fc !important; }
html.dark-mode .metode-txt { background:#1e3a5f !important; color:#7dd3fc !important; }
html.dark-mode .total-txt { color:#7dd3fc !important; }
</style>

<script src="https://cdn.jsdelivr.net/npm/chart.js@4"></script>
<script>
document.querySelectorAll('.ftab').forEach(btn => {
  btn.addEventListener('click', function() {
    document.querySelectorAll('.ftab').forEach(b => b.classList.remove('active'));
    this.classList.add('active');
    applyFilter();
  });
});

document.getElementById('searchInp').addEventListener('input', applyFilter);

function applyFilter() {
  const filter = document.querySelector('.ftab.active').dataset.filter;
  const search = document.getElementById('searchInp').value.toLowerCase();
  document.querySelectorAll('#pesananTbl tbody tr[data-status]').forEach(row => {
    const matchFilter = filter === 'all' || row.dataset.status === filter;
    const matchSearch = !search || row.dataset.search.includes(search);
    row.classList.toggle('row-hidden', !(matchFilter && matchSearch));
  });
}

const salesCtx = document.getElementById('salesChart');
if (salesCtx) {
  new Chart(salesCtx, {
    type: 'line',
    data: {
      labels: <?php echo json_encode($chartLabels, 15, 512) ?>,
      datasets: [{
        label: 'Penjualan (Rp)',
        data: <?php echo json_encode($chartTotals, 15, 512) ?>,
        borderColor: '#2563eb',
        backgroundColor: 'rgba(37,99,235,0.12)',
        borderWidth: 2.5,
        tension: 0.38,
        fill: true,
        pointRadius: 4,
        pointBackgroundColor: '#2563eb',
        pointBorderColor: '#fff',
        pointBorderWidth: 2,
      }]
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      plugins: {
        legend: { display: false },
        tooltip: {
          backgroundColor: '#1e40af',
          callbacks: { label: ctx => 'Rp ' + ctx.parsed.y.toLocaleString('id-ID') }
        }
      },
      scales: {
        x: { ticks: { color: '#94a3b8', font:{size:11} }, grid: { color: '#f1f5f9' } },
        y: {
          ticks: { color: '#94a3b8', font:{size:11}, callback: v => 'Rp ' + (v >= 1000000 ? (v/1000000).toFixed(1)+'jt' : v >= 1000 ? (v/1000)+'k' : v) },
          grid: { color: '#f1f5f9' }
        }
      }
    }
  });
}
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\BioAquaLab\BioAquaLab\resources\views/pesanan/admin.blade.php ENDPATH**/ ?>