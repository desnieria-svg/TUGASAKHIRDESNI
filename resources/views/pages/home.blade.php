@extends('layouts.app')

@section('content')

{{-- Auth status untuk JS --}}
<meta name="user-auth" content="{{ auth()->check() ? 'true' : 'false' }}">
<meta name="login-url" content="{{ route('login') }}">

{{-- Modal Login Required --}}
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


  @if(auth()->check() && auth()->user()->role === 'admin')
  <div class="admin-home-section">
      <div class="dashboard-header" style="margin:24px 0 16px;">
          <div class="role-badge">⚙️ Mode Admin</div>
          <h1 style="font-size:1.5rem;font-weight:800;color:#0f172a;margin-bottom:4px;">Halo, {{ auth()->user()->name }}! 👋</h1>
          <p style="color:#64748b;font-size:0.92rem;">Ringkasan toko, produk, dan pesanan BioAqua Lab.</p>
      </div>

      <div class="admin-home-grid">
          @foreach($stats as $stat)
              <x-stat-card :judul="$stat['judul']" :nilai="$stat['nilai']" :ikon="$stat['ikon']" :warna="$stat['warna']" />
          @endforeach
      </div>

      {{-- GRAFIK STOK PER KATEGORI --}}
      <div class="admin-chart-card">
          <h3>📊 Stok Produk per Kategori</h3>
          @forelse($kategoriStats as $k)
              @php
                  $labelKat = ['galon'=>'Air Galon','botol'=>'Air Botol','jerigen'=>'Air Jerigen','cup'=>'Air Cup'][$k['kategori']] ?? ucfirst($k['kategori']);
              @endphp
              <div class="admin-bar-row">
                  <span class="admin-bar-label">{{ $labelKat }}</span>
                  <div class="admin-bar-track">
                      <div class="admin-bar-fill" style="width:{{ $k['persen'] }}%;"></div>
                  </div>
                  <span class="admin-bar-val">{{ $k['total_stok'] }}</span>
              </div>
          @empty
              <p style="color:#94a3b8;font-size:0.85rem;">Belum ada data produk.</p>
          @endforelse
      </div>

      {{-- PESANAN TERBARU --}}
      <div class="admin-chart-card">
          <h3>📋 Pesanan Terbaru</h3>
          <div style="overflow-x:auto;">
          <table class="data-table" style="width:100%;">
              <thead>
                  <tr>
                      <th>Pelanggan</th>
                      <th>Produk</th>
                      <th>Total</th>
                      <th>Status</th>
                  </tr>
              </thead>
              <tbody>
                  @forelse($pesananTerbaru as $p)
                      <tr>
                          <td style="font-weight:600">{{ $p->nama_pelanggan }}</td>
                          <td>{{ $p->nama_produk }}</td>
                          <td style="font-weight:bold;color:#2563eb">Rp {{ number_format($p->total_harga, 0, ',', '.') }}</td>
                          <td><span class="status {{ $p->status }}">{{ strtoupper($p->status) }}</span></td>
                      </tr>
                  @empty
                      <tr><td colspan="4" style="text-align:center;color:#94a3b8">Belum ada data pesanan.</td></tr>
                  @endforelse
              </tbody>
          </table>
          </div>
          <div style="margin-top:14px;text-align:right;">
              <a href="{{ route('admin.pesanan') }}" style="font-size:0.85rem;font-weight:700;color:#0284c7;text-decoration:none;">Lihat semua pesanan →</a>
          </div>
      </div>

      <h2 class="admin-home-title">📦 Daftar Produk</h2>
  </div>
  @else
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

  {{-- Section Cuaca Jember --}}
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
  @endif

  @unless(auth()->check() && auth()->user()->role === 'admin')
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
  @endunless

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

          @php
            $kategoriIcon = ['galon'=>'💧','botol'=>'🍶','jerigen'=>'🪣','cup'=>'🥤'];
            $kategoriLabel= ['galon'=>'Air Galon','botol'=>'Air Botol','jerigen'=>'Air Jerigen','cup'=>'Air Cup'];
          @endphp

          @forelse ($barang as $item)
            @php
              $status = $item->jumlah > 0 ? 'tersedia' : 'habis';
              $ikon   = $kategoriIcon[$item->kategori] ?? '💧';
              $label  = $kategoriLabel[$item->kategori] ?? ucfirst($item->kategori);
            @endphp
            <article class="product-card"
              data-kategori="{{ $item->kategori }}"
              data-harga="{{ $item->harga }}"
              data-status="{{ $status }}"
              data-aos>

              @if($item->jumlah <= 0)
                <div class="card-badge habis">Habis</div>
              @elseif($item->jumlah <= 5 && auth()->check() && auth()->user()->role === 'admin')
                <div class="card-badge" style="background:#f59e0b;">Stok Tipis</div>
              @endif

              {{-- Foto produk --}}
              @php
                $fotoFilename = $item->foto ? basename($item->foto) : null;
                $fotoPublic   = $fotoFilename ? public_path('images/produk/' . $fotoFilename) : null;
                $fotoUrl      = ($fotoFilename && file_exists($fotoPublic))
                    ? '/images/produk/' . rawurlencode($fotoFilename)
                    : (($item->foto && file_exists(public_path('storage/'.$item->foto)))
                        ? '/storage/' . str_replace('%2F','/',rawurlencode($item->foto)) : null);
              @endphp
              @if($fotoUrl)
                <div class="card-img {{ $item->kategori }}" style="padding:0;overflow:hidden;">
                  <img src="{{ $fotoUrl }}" alt="{{ $item->nama }}" style="width:100%;height:100%;object-fit:cover;">
                </div>
              @else
                <div class="card-img {{ $item->kategori }}">{{ $ikon }}</div>
              @endif

              <div class="card-body">
                <span class="card-cat">{{ $label }}</span>
                <h3>{{ $item->nama }}</h3>
                <p>Kode: <strong>{{ $item->kode }}</strong> &middot; Stok: {{ $item->jumlah }} {{ $item->satuan }}</p>
                <div class="card-footer">
                  <strong class="card-price">Rp {{ number_format($item->harga, 0, ',', '.') }}</strong>
                  @if($item->jumlah > 0)
                    <button class="btn btn-primary btn-sm"
                      onclick="tambahKeranjang(this, '{{ addslashes($item->nama) }}', {{ $item->harga }}, '{{ $ikon }}', {{ $item->id }}, '{{ $item->kategori }}', '{{ $fotoUrl ?? '' }}', {{ $item->jumlah }})">
                      + Pesan
                    </button>
                  @else
                    <button class="btn btn-disabled btn-sm" disabled>Habis</button>
                  @endif
                </div>
              </div>
            </article>
          @empty
            <div style="grid-column:1/-1;text-align:center;padding:60px 20px;">
              <div style="font-size:3rem;margin-bottom:16px;">📦</div>
              <h3 style="color:#64748b;font-weight:600;">Belum Ada Produk</h3>
              <p style="color:#94a3b8;font-size:0.9rem;">Admin belum menambahkan produk apapun.</p>
              @auth
                @if(auth()->user()->role === 'admin')
                  <a href="{{ route('barang.create') }}" style="display:inline-flex;align-items:center;gap:8px;margin-top:16px;background:linear-gradient(135deg,#0ea5e9,#0284c7);color:#fff;padding:10px 24px;border-radius:10px;text-decoration:none;font-weight:600;">
                    ➕ Tambah Produk Pertama
                  </a>
                @endif
              @endauth
            </div>
          @endforelse

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

  <script src="{{ asset('js/script.js') }}"></script>

@endsection

{{-- ✅ @push di luar @section tapi BUKAN setelah @endsection yang menutup konten --}}
@push('scripts')
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

// tambahKeranjang — cek login dulu, lalu delegasikan ke window.tambahKeranjang (navbar, sudah validasi stok)
const _tambahKeranjangAsli = window.tambahKeranjang;
window.tambahKeranjang = function(btn, namaProduk, harga, ikon, id, kategori, foto, stok) {
  if (!isLoggedIn) {
    document.getElementById('modal-login').style.display = 'flex';
    return;
  }
  _tambahKeranjangAsli(btn, namaProduk, harga, ikon, id, kategori, foto, stok);
  if (typeof tampilToast === 'function' && window._cart[namaProduk] && window._cart[namaProduk].qty > 0) {
    tampilToast('🛒 ' + namaProduk + ' ditambahkan ke keranjang!');
  }
};

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
@endpush