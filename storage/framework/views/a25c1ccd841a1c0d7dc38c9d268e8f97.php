<?php $__env->startSection('title', 'Dashboard'); ?>
<?php $__env->startSection('content'); ?>

<style>
.dashboard-wrapper {
    max-width: 1200px;
    margin: 0 auto;
    padding: 32px 24px;
}
.dashboard-header {
    margin-bottom: 32px;
}
.dashboard-header h1 { font-size: 1.6rem; font-weight: 700; color: #0f172a; margin-bottom: 6px; }
.dashboard-header p { color: #64748b; font-size: 0.95rem; }
.role-badge {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    background: #e0f2fe;
    color: #0369a1;
    padding: 4px 14px;
    border-radius: 99px;
    font-size: 0.8rem;
    font-weight: 600;
    margin-bottom: 12px;
}
.stat-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(180px, 1fr)); gap: 16px; margin-bottom: 32px; }
.dashboard-table { background: #fff; border-radius: 14px; padding: 24px; box-shadow: 0 1px 6px rgba(0,0,0,0.07); border: 1px solid #e2e8f0; margin-bottom: 24px; }
.dashboard-table h2 { font-size: 1.05rem; font-weight: 700; color: #1e293b; margin-bottom: 16px; }
.quick-actions { display: grid; grid-template-columns: repeat(auto-fit, minmax(160px, 1fr)); gap: 12px; margin-bottom: 32px; }
.action-card {
    background: #fff;
    border: 1px solid #e2e8f0;
    border-radius: 12px;
    padding: 20px 16px;
    text-align: center;
    text-decoration: none;
    color: #1e293b;
    transition: 0.2s;
    display: flex; flex-direction: column; align-items: center; gap: 8px;
}
.action-card:hover { border-color: #0ea5e9; background: #f0f9ff; transform: translateY(-2px); box-shadow: 0 4px 12px rgba(14,165,233,0.15); }
.action-card span { font-size: 2rem; }
.action-card strong { font-size: 0.88rem; font-weight: 600; color: #334155; }
.action-card small { font-size: 0.75rem; color: #94a3b8; }

/* Dark mode dashboard */
.dark-mode .dashboard-wrapper { background: transparent; }
.dark-mode .dashboard-header h1 { color: #f1f5f9 !important; }
.dark-mode .dashboard-header p { color: #94a3b8 !important; }
.dark-mode .role-badge { background: #1e3a5f !important; color: #38bdf8 !important; }
.dark-mode .dashboard-table { background: #16213e !important; border-color: #334155 !important; }
.dark-mode .dashboard-table h2 { color: #f1f5f9 !important; }
.dark-mode .action-card { background: #16213e !important; border-color: #334155 !important; color: #e2e8f0 !important; }
.dark-mode .action-card:hover { background: #1e3a5f !important; border-color: #38bdf8 !important; }
.dark-mode .action-card strong { color: #cbd5e1 !important; }
.dark-mode .action-card small { color: #64748b !important; }

.dash-produk-grid { display:grid; grid-template-columns:repeat(auto-fill,minmax(180px,1fr)); gap:16px; }
.dash-produk-card { background:#fff; border:1px solid #e2e8f0; border-radius:14px; overflow:hidden; transition:.2s; }
.dash-produk-card:hover { transform:translateY(-3px); box-shadow:0 6px 18px rgba(0,0,0,0.08); }
.dash-produk-img { width:100%; height:120px; display:flex; align-items:center; justify-content:center; background:#f0f9ff; overflow:hidden; }
.dash-produk-img img { width:100%; height:100%; object-fit:cover; }
.dash-produk-icon { font-size:2.6rem; }
.dash-produk-body { padding:14px; }
.dash-produk-cat { font-size:.7rem; font-weight:700; color:#0284c7; background:#e0f2fe; padding:2px 8px; border-radius:99px; }
.dash-produk-body h3 { font-size:.92rem; font-weight:700; margin:8px 0; color:#1e293b; }
.dash-produk-foot { display:flex; align-items:center; justify-content:space-between; gap:8px; }
.dash-produk-foot strong { color:#0284c7; font-size:.9rem; }
.dark-mode .dash-produk-card { background:#16213e !important; border-color:#334155 !important; }
.dark-mode .dash-produk-img { background:#0f172a !important; }
.dark-mode .dash-produk-body h3 { color:#f1f5f9 !important; }
</style>

<div class="dashboard-wrapper">

    <div class="dashboard-header">
        <?php if(auth()->user()->role === 'admin'): ?>
            <div class="role-badge">⚙️ Mode Admin</div>
        <?php else: ?>
            <div class="role-badge">👤 Mode User</div>
        <?php endif; ?>
        <h1>Halo, <?php echo e(auth()->user()->name); ?>! 👋</h1>
        <p>Selamat datang di dashboard BioAqua Lab. Berikut ringkasan aktivitas Anda.</p>
    </div>

    
    <div class="stat-grid">
        <?php $__empty_1 = true; $__currentLoopData = $stats; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $stat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <?php if (isset($component)) { $__componentOriginal527fae77f4db36afc8c8b7e9f5f81682 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal527fae77f4db36afc8c8b7e9f5f81682 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.stat-card','data' => ['judul' => $stat['judul'],'nilai' => $stat['nilai'],'ikon' => $stat['ikon'],'warna' => $stat['warna']]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('stat-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['judul' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($stat['judul']),'nilai' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($stat['nilai']),'ikon' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($stat['ikon']),'warna' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($stat['warna'])]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal527fae77f4db36afc8c8b7e9f5f81682)): ?>
<?php $attributes = $__attributesOriginal527fae77f4db36afc8c8b7e9f5f81682; ?>
<?php unset($__attributesOriginal527fae77f4db36afc8c8b7e9f5f81682); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal527fae77f4db36afc8c8b7e9f5f81682)): ?>
<?php $component = $__componentOriginal527fae77f4db36afc8c8b7e9f5f81682; ?>
<?php unset($__componentOriginal527fae77f4db36afc8c8b7e9f5f81682); ?>
<?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <p style="color:#94a3b8">Tidak ada data statistik.</p>
        <?php endif; ?>
    </div>

    
    <?php if(auth()->user()->role === 'admin'): ?>
        <div class="dashboard-table">
            <h2>⚡ Menu Admin</h2>
            <div class="quick-actions">
                <a href="<?php echo e(route('barang.index')); ?>" class="action-card">
                    <span>📦</span>
                    <strong>Inventaris Barang</strong>
                    <small>Lihat & kelola stok</small>
                </a>
                <a href="<?php echo e(route('barang.create')); ?>" class="action-card">
                    <span>➕</span>
                    <strong>Tambah Barang</strong>
                    <small>Input barang baru</small>
                </a>
                <a href="<?php echo e(route('admin.pesanan')); ?>" class="action-card">
                    <span>📋</span>
                    <strong>Kelola Pesanan</strong>
                    <small>Proses & update status</small>
                </a>
                <a href="<?php echo e(route('barang.search')); ?>" class="action-card">
                    <span>🔍</span>
                    <strong>Cari Barang</strong>
                    <small>Pencarian cepat</small>
                </a>
            </div>
        </div>
    <?php else: ?>
        <div class="dashboard-table">
            <h2>⚡ Menu Saya</h2>
            <div class="quick-actions">
                <a href="<?php echo e(url('/')); ?>#produk" class="action-card">
                    <span>🛒</span>
                    <strong>Pesan Produk</strong>
                    <small>Lihat & pesan air</small>
                </a>
                <a href="<?php echo e(route('pesanan.riwayat')); ?>" class="action-card">
                    <span>📋</span>
                    <strong>Riwayat Pesanan</strong>
                    <small>Lihat transaksi kamu</small>
                </a>
                <a href="<?php echo e(url('/preferensi')); ?>" class="action-card">
                    <span>🎨</span>
                    <strong>Preferensi</strong>
                    <small>Atur tampilan</small>
                </a>
            </div>
        </div>

        
        <div class="dashboard-table">
            <h2>🛍️ Produk Tersedia</h2>
            <?php
              $kategoriIcon = ['galon'=>'💧','botol'=>'🍶','jerigen'=>'🪣','cup'=>'🥤'];
              $kategoriLabel= ['galon'=>'Air Galon','botol'=>'Air Botol','jerigen'=>'Air Jerigen','cup'=>'Air Cup'];
            ?>
            <div class="dash-produk-grid">
              <?php $__empty_1 = true; $__currentLoopData = $barang; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <?php
                  $ikon  = $kategoriIcon[$item->kategori] ?? '💧';
                  $label = $kategoriLabel[$item->kategori] ?? ucfirst($item->kategori);
                  $fotoFilename = $item->foto ? basename($item->foto) : null;
                  $fotoPublic   = $fotoFilename ? public_path('images/produk/' . $fotoFilename) : null;
                  $fotoUrl      = ($fotoFilename && file_exists($fotoPublic))
                      ? asset('images/produk/' . $fotoFilename)
                      : (($item->foto && file_exists(public_path('storage/'.$item->foto)))
                          ? asset('storage/'.$item->foto) : null);
                ?>
                <div class="dash-produk-card">
                  <?php if($fotoUrl): ?>
                    <div class="dash-produk-img"><img src="<?php echo e($fotoUrl); ?>" alt="<?php echo e($item->nama); ?>"></div>
                  <?php else: ?>
                    <div class="dash-produk-img dash-produk-icon"><?php echo e($ikon); ?></div>
                  <?php endif; ?>
                  <div class="dash-produk-body">
                    <span class="dash-produk-cat"><?php echo e($label); ?></span>
                    <h3><?php echo e($item->nama); ?></h3>
                    <div class="dash-produk-foot">
                      <strong>Rp <?php echo e(number_format($item->harga, 0, ',', '.')); ?></strong>
                      <?php if($item->jumlah > 0): ?>
                        <button class="btn btn-primary btn-sm"
                          onclick="tambahKeranjang(this, '<?php echo e(addslashes($item->nama)); ?>', <?php echo e($item->harga); ?>, '<?php echo e($ikon); ?>', <?php echo e($item->id); ?>, '<?php echo e($item->kategori); ?>', '<?php echo e($fotoUrl ?? ''); ?>')">
                          + Pesan
                        </button>
                      <?php else: ?>
                        <button class="btn btn-disabled btn-sm" disabled>Habis</button>
                      <?php endif; ?>
                    </div>
                  </div>
                </div>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <p style="color:#94a3b8">Belum ada produk tersedia.</p>
              <?php endif; ?>
            </div>
        </div>
    <?php endif; ?>

    
    <?php if(auth()->user()->role === 'admin'): ?>
    <div class="dashboard-table">
        <h2>📋 Daftar Pesanan Terbaru</h2>
        <table class="data-table">
            <thead>
                <tr>
                    <th>Pelanggan</th>
                    <th>Produk</th>
                    <th>Jumlah</th>
                    <th>Total Harga</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $barangTerbaru; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pesanan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td style="font-weight:600"><?php echo e($pesanan->nama_pelanggan); ?></td>
                        <td><?php echo e($pesanan->nama_produk); ?></td>
                        <td><?php echo e($pesanan->jumlah); ?></td>
                        <td style="font-weight:bold;color:#2563eb">Rp <?php echo e(number_format($pesanan->total_harga, 0, ',', '.')); ?></td>
                        <td><span class="status <?php echo e($pesanan->status); ?>"><?php echo e(strtoupper($pesanan->status)); ?></span></td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr><td colspan="5" style="text-align:center;color:#94a3b8">Belum ada data pesanan.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    <?php endif; ?>

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\BioAquaLab\bioaqua\resources\views/dashboard.blade.php ENDPATH**/ ?>