<?php $__env->startSection('content'); ?>


<meta name="user-auth" content="<?php echo e(auth()->check() ? 'true' : 'false'); ?>">
<meta name="login-url" content="<?php echo e(route('login')); ?>">


<div id="modal-login" style="display:none;position:fixed;inset:0;z-index:9999;background:rgba(0,0,0,0.5);backdrop-filter:blur(4px);align-items:center;justify-content:center;">
  <div style="background:#fff;border-radius:20px;padding:40px;max-width:420px;width:90%;text-align:center;box-shadow:0 20px 60px rgba(0,0,0,0.3);animation:modalPop 0.3s ease;">
    <div style="font-size:3rem;margin-bottom:16px;">🔒</div>
    <h3 style="font-size:1.4rem;font-weight:800;color:#0f172a;margin:0 0 10px;">Login Diperlukan</h3>
    <p style="color:#64748b;font-size:0.95rem;margin:0 0 24px;line-height:1.6;">
      Kamu harus login terlebih dahulu untuk memesan produk BioAqua Lab.
    </p>
    <div style="display:flex;gap:12px;justify-content:center;">
      <button onclick="document.getElementById('modal-login').style.display='none'" 
        style="padding:10px 22px;border:1.5px solid #e2e8f0;border-radius:10px;font-size:0.9rem;font-weight:600;color:#374151;background:#fff;cursor:pointer;">
        Nanti Dulu
      </button>
      <a id="modal-login-btn" href="#" 
        style="padding:10px 22px;background:linear-gradient(135deg,#0ea5e9,#0284c7);color:#fff;border:none;border-radius:10px;font-size:0.9rem;font-weight:700;cursor:pointer;text-decoration:none;display:inline-flex;align-items:center;gap:6px;">
        🚀 Login Sekarang
      </a>
    </div>
  </div>
</div>
<style>
@keyframes modalPop {
  from { opacity:0; transform:scale(0.9) translateY(20px); }
  to   { opacity:1; transform:scale(1) translateY(0); }
}
</style>


  <!-- HERO SECTION -->
  <section class="hero" id="home">

    <div class="bubble b1"></div>
    <div class="bubble b2"></div>
    <div class="bubble b3"></div>
    <div class="bubble b4"></div>

    <div class="hero-content">
      <p class="hero-tagline">✦ Sistem Manajemen Air Minum</p>
      <h1 class="hero-title">
        Selamat Datang di<br />
        <span>BioAqua Lab</span>
      </h1>

      <p class="hero-desc">
        Air Minum Isi Ulang Kepercayaan Kita — Kelola stok, pemesanan, dan
        distribusi air mineral berkualitas dengan mudah dan efisien.
      </p>
      <div class="hero-actions">
        <a href="#produk" class="btn btn-white" onclick="cekLoginPesanan(event)">Buat Pesanan</a>
        <a href="#produk"  class="btn btn-ghost">Lihat Produk</a>
      </div>
      <div class="hero-chips">
        <span class="chip">💧 100% Murni</span>
        <span class="chip">🏆 Bersertifikat</span>
        <span class="chip">🚚 Antar ke Rumah</span>
      </div>
    </div>

    <div class="hero-visual">
      <div class="water-bottle">
        <div class="bottle-body">
          <div class="water-fill"></div>
          <div class="bottle-label">
            <strong>BioAqua</strong>
            <small>Premium Water</small>
          </div>
        </div>
        <div class="bottle-cap"></div>
      </div>
    </div>
  </section>

  
  <div class="container my-4">
    <div class="card shadow-sm">
        <div class="card-body">
            <h5 class="card-title">🌤️ Cuaca Hari Ini — Kota Jember</h5>

            <div id="cuaca-loading" class="text-muted">
                <div class="spinner-border spinner-border-sm text-primary" role="status"></div>
                Sedang mengambil data cuaca...
            </div>

            <div id="cuaca-result" style="display:none;">
                <p class="mb-1">📍 Kota: <strong id="cuaca-kota"></strong></p>
                <p class="mb-1">🌡️ Suhu: <strong id="cuaca-suhu"></strong>°C</p>
                <p class="mb-0">☁️ Kondisi: <strong id="cuaca-deskripsi"></strong></p>
            </div>

            <div id="cuaca-error" class="text-danger" style="display:none;">
                ⚠️ Gagal mengambil data cuaca.
            </div>
        </div>
    </div>
  </div>

  <!-- STATISTIK SINGKAT -->
  <section class="stats-bar">
    <div class="container">
      <div class="stats-grid">
        <div class="stat-item" data-aos>
          <strong>2.500+</strong>
          <span>Pelanggan Aktif</span>
        </div>
        <div class="stat-item" data-aos>
          <strong>15 Ton</strong>
          <span>Air Diproses / Hari</span>
        </div>
        <div class="stat-item" data-aos>
          <strong>99.8%</strong>
          <span>Tingkat Kemurnian</span>
        </div>
        <div class="stat-item" data-aos>
          <strong>8 Tahun</strong>
          <span>Pengalaman</span>
        </div>
      </div>
    </div>
  </section>

  <section class="produk-section" id="produk">
    <div class="container">
      <div class="section-header" data-aos>
        <p class="section-label">Katalog</p>
        <h2 class="section-title">Produk Air Kami</h2>
        <p class="section-desc">Pilih produk air minum berkualitas sesuai kebutuhan Anda</p>
      </div>

      <div class="produk-layout">

        <!-- SIDEBAR FILTER -->
        <aside class="sidebar" id="sidebar">
          <div class="sidebar-header">
            <h3>🔍 Filter Produk</h3>
          </div>

          <div class="filter-group">
            <h4>Kategori</h4>
            <label class="checkbox-label">
              <input type="checkbox" value="galon" checked onchange="filterProduk()" />
              <span>Air Galon</span>
            </label>
            <label class="checkbox-label">
              <input type="checkbox" value="botol" checked onchange="filterProduk()" />
              <span>Air Botol</span>
            </label>
            <label class="checkbox-label">
              <input type="checkbox" value="cup" checked onchange="filterProduk()" />
              <span>Air Cup</span>
            </label>
          </div>

          <div class="filter-group">
            <h4>Harga Maksimal</h4>
            <input type="range" id="hargaRange" min="5000" max="100000"
                   value="100000" step="5000" oninput="updateHargaFilter(this)" />
            <p class="range-label">Maks: <span id="hargaLabel">Rp 100.000</span></p>
          </div>

          <div class="filter-group">
            <h4>Ketersediaan</h4>
            <label class="checkbox-label">
              <input type="checkbox" value="tersedia" checked onchange="filterProduk()" />
              <span>Tersedia</span>
            </label>
            <label class="checkbox-label">
              <input type="checkbox" value="habis" onchange="filterProduk()" />
              <span>Habis</span>
            </label>
          </div>

          <button class="btn btn-primary btn-full" onclick="resetFilter()">
            Reset Filter
          </button>
        </aside>

        <!-- GRID KARTU PRODUK - dari database -->
        <main class="produk-grid" id="produkGrid">

          <?php
            $kategoriIcon = ['galon'=>'💧','botol'=>'🍶','jerigen'=>'🪣','cup'=>'🥤'];
            $kategoriLabel= ['galon'=>'Air Galon','botol'=>'Air Botol','jerigen'=>'Air Jerigen','cup'=>'Air Cup'];
          ?>

          <?php $__empty_1 = true; $__currentLoopData = $barang; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <?php
              $status = $item->jumlah > 0 ? 'tersedia' : 'habis';
              $ikon   = $kategoriIcon[$item->kategori] ?? '💧';
              $label  = $kategoriLabel[$item->kategori] ?? ucfirst($item->kategori);
            ?>
            <article class="product-card"
              data-kategori="<?php echo e($item->kategori); ?>"
              data-harga="<?php echo e($item->harga); ?>"
              data-status="<?php echo e($status); ?>"
              data-aos>

              <?php if($item->jumlah <= 0): ?>
                <div class="card-badge habis">Habis</div>
              <?php elseif($item->jumlah <= 5): ?>
                <div class="card-badge" style="background:#f59e0b;">Stok Tipis</div>
              <?php endif; ?>

              
              <?php
                $fotoFilename = $item->foto ? basename($item->foto) : null;
                $fotoPublic   = $fotoFilename ? public_path('images/produk/' . $fotoFilename) : null;
                $fotoUrl      = ($fotoFilename && file_exists($fotoPublic))
                    ? asset('images/produk/' . $fotoFilename)
                    : (($item->foto && file_exists(public_path('storage/'.$item->foto)))
                        ? asset('storage/'.$item->foto) : null);
              ?>
              <?php if($fotoUrl): ?>
                <div class="card-img <?php echo e($item->kategori); ?>" style="padding:0;overflow:hidden;">
                  <img src="<?php echo e($fotoUrl); ?>" alt="<?php echo e($item->nama); ?>" style="width:100%;height:100%;object-fit:cover;">
                </div>
              <?php else: ?>
                <div class="card-img <?php echo e($item->kategori); ?>"><?php echo e($ikon); ?></div>
              <?php endif; ?>

              <div class="card-body">
                <span class="card-cat"><?php echo e($label); ?></span>
                <h3><?php echo e($item->nama); ?></h3>
                <p>Kode: <strong><?php echo e($item->kode); ?></strong> &middot; Stok: <?php echo e($item->jumlah); ?> <?php echo e($item->satuan); ?></p>
                <div class="card-footer">
                  <strong class="card-price">Rp <?php echo e(number_format($item->harga, 0, ',', '.')); ?></strong>
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
            </article>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <div style="grid-column:1/-1;text-align:center;padding:60px 20px;">
              <div style="font-size:3rem;margin-bottom:16px;">📦</div>
              <h3 style="color:#64748b;font-weight:600;">Belum Ada Produk</h3>
              <p style="color:#94a3b8;font-size:0.9rem;">Admin belum menambahkan produk apapun.</p>
              <?php if(auth()->guard()->check()): ?>
                <?php if(auth()->user()->role === 'admin'): ?>
                  <a href="<?php echo e(route('barang.create')); ?>" style="display:inline-flex;align-items:center;gap:8px;margin-top:16px;background:linear-gradient(135deg,#0ea5e9,#0284c7);color:#fff;padding:10px 24px;border-radius:10px;text-decoration:none;font-weight:600;">
                    ➕ Tambah Produk Pertama
                  </a>
                <?php endif; ?>
              <?php endif; ?>
            </div>
          <?php endif; ?>

        </main>
      </div>
    </div>
  </section>



  <!-- Tombol Kembali ke Atas -->
  <button class="back-to-top" id="backToTop" aria-label="Kembali ke atas">↑</button>

  <!-- Notifikasi Toast -->
  <div class="toast" id="toast">
    <span id="toastMsg">Pesan berhasil!</span>
  </div>

  <script src="<?php echo e(asset('js/script.js')); ?>"></script>

<?php $__env->stopSection(); ?>


<?php $__env->startPush('scripts'); ?>
<script>
// === AUTH CHECK ===
function cekLoginPesanan(e) {
  if (!isLoggedIn) {
    e.preventDefault();
    document.getElementById('modal-login').style.display = 'flex';
  }
  // if logged in, scroll to #produk naturally
}

const isLoggedIn = document.querySelector('meta[name="user-auth"]')?.content === 'true';
const loginUrl   = document.querySelector('meta[name="login-url"]')?.content || '/login';

// Set login URL on modal button
const modalBtn = document.getElementById('modal-login-btn');
if (modalBtn) modalBtn.href = loginUrl;

// Close modal when clicking backdrop
document.getElementById('modal-login').addEventListener('click', function(e) {
  if (e.target === this) this.style.display = 'none';
});

// tambahKeranjang — cek login dulu, lalu masukkan ke cart navbar
function tambahKeranjang(btn, namaProduk, harga, ikon, id, kategori, foto) {
  if (!isLoggedIn) {
    document.getElementById('modal-login').style.display = 'flex';
    return;
  }

  // Inisialisasi cart global kalau belum ada
  if (!window._cart) window._cart = {};

  // Tambah item ke cart
  if (!window._cart[namaProduk]) {
    window._cart[namaProduk] = {
      id: id || 0,
      nama: namaProduk,
      harga: harga || 0,
      icon: ikon || '💧',
      kategori: kategori || '',
      foto: foto || '',
      qty: 0
    };
  }
  window._cart[namaProduk].qty++;

  // Update badge & render panel keranjang
  if (typeof renderCart === 'function') renderCart();

  // Animasi tombol
  const asliTeks = btn.textContent;
  btn.textContent = '✓ Ditambah!';
  btn.style.background = '#16a34a';
  btn.disabled = true;
  setTimeout(function () {
    btn.textContent = asliTeks;
    btn.style.background = '';
    btn.disabled = false;
  }, 1200);

  // Toast notif
  if (typeof tampilToast === 'function') {
    tampilToast('🛒 ' + namaProduk + ' ditambahkan ke keranjang!');
  }
}

// === CUACA JEMBER ===
async function ambilCuaca() {
    try {
        const lat = -8.1845, lon = 113.6680;
        const url = `https://api.open-meteo.com/v1/forecast?latitude=${lat}&longitude=${lon}&current=temperature_2m,weather_code,weathercode&timezone=Asia%2FJakarta`;
        const res  = await fetch(url);
        if (!res.ok) throw new Error('HTTP ' + res.status);
        const data = await res.json();
        if (!data.current) throw new Error('No current data');
        const suhu = data.current.temperature_2m;
        const code = data.current.weather_code ?? data.current.weathercode ?? 0;
        const cuacaMap = {
            0:'☀️ Cerah', 1:'🌤️ Cerah Berawan', 2:'⛅ Berawan', 3:'☁️ Mendung',
            45:'🌫️ Berkabut', 48:'🌫️ Kabut Beku',
            51:'🌦️ Gerimis', 53:'🌦️ Gerimis Sedang', 55:'🌧️ Gerimis Lebat',
            61:'🌧️ Hujan Ringan', 63:'🌧️ Hujan', 65:'🌧️ Hujan Lebat',
            71:'❄️ Salju Ringan', 73:'❄️ Salju', 75:'❄️ Salju Lebat',
            80:'🌦️ Hujan Lokal', 81:'🌧️ Hujan Deras', 82:'⛈️ Hujan Sangat Deras',
            95:'⛈️ Badai Petir', 96:'⛈️ Badai + Hujan Es', 99:'⛈️ Badai Parah',
        };
        const deskripsi = cuacaMap[code] || '🌡️ Tidak Diketahui';
        document.getElementById('cuaca-kota').textContent      = 'Jember';
        document.getElementById('cuaca-suhu').textContent      = suhu;
        document.getElementById('cuaca-deskripsi').textContent = deskripsi;
        document.getElementById('cuaca-loading').style.display = 'none';
        document.getElementById('cuaca-result').style.display  = 'block';
    } catch (error) {
        console.error('Cuaca error:', error);
        document.getElementById('cuaca-loading').style.display = 'none';
        document.getElementById('cuaca-error').style.display   = 'block';
    }
}

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', ambilCuaca);
} else {
    ambilCuaca();
}
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\BioAquaLab\bioaqua\resources\views/pages/home.blade.php ENDPATH**/ ?>