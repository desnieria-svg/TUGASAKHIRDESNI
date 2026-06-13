@extends('layouts.app')
@section('title','Pesanan Berhasil')
@section('content')

@php
$isCod = ($pesanan->metode_bayar === 'cod');
$isQris = ($pesanan->metode_bayar === 'qris');
$isTransfer = str_starts_with($pesanan->metode_bayar ?? '', 'transfer_');
$metodeLabel = strtoupper(str_replace('_',' ',$pesanan->metode_bayar ?? '-'));
@endphp

<div class="sks-page">
<div class="sks-wrap">

  <div class="sks-card">
    <div class="sks-top-bar"></div>
    <div class="sks-icon">🎉</div>
    <h1 class="sks-title">Pesanan Berhasil!</h1>
    <p class="sks-sub">Terima kasih, <strong>{{ $pesanan->nama_pelanggan }}</strong>!<br>Pesananmu telah diterima & sedang diproses.</p>

    <div class="order-info">
      <div class="order-row">
        <span>Kode Pesanan</span>
        <strong class="kode-val">{{ $pesanan->kode_pesanan ?? '#'.$pesanan->id }}</strong>
      </div>
      <div class="order-row">
        <span>Produk</span>
        <span>{{ $pesanan->nama_produk }}</span>
      </div>
      <div class="order-row">
        <span>Total</span>
        <strong class="total-val">Rp {{ number_format($pesanan->total_harga,0,',','.') }}</strong>
      </div>
      <div class="order-row">
        <span>Pengiriman</span>
        <span>{{ ($pesanan->jenis_pengiriman ?? 'antar') === 'jemput' ? '🏪 Ambil sendiri' : '🚐 Diantar ke alamat' }}</span>
      </div>
      <div class="order-row">
        <span>Metode Bayar</span>
        <span class="metode-tag">{{ $metodeLabel }}</span>
      </div>
      <div class="order-row">
        <span>Status</span>
        <span class="status-pill">⏳ Menunggu Konfirmasi</span>
      </div>
    </div>

    {{-- Instruksi sesuai metode --}}
    @if($isCod)
    <div class="info-box green">
      <div class="ib-icon">💵</div>
      <div>
        <div class="ib-title">Bayar Saat Pengiriman</div>
        <p>Siapkan uang tunai sejumlah <strong>Rp {{ number_format($pesanan->total_harga,0,',','.') }}</strong>. Admin akan menghubungi kamu via WhatsApp sebelum pengiriman.</p>
      </div>
    </div>
    @elseif($isQris)
    <div class="info-box blue">
      <div class="ib-icon">📱</div>
      <div>
        <div class="ib-title">Pembayaran QRIS</div>
        <p>Total yang harus dibayar: <strong>Rp {{ number_format($pesanan->total_harga,0,',','.') }}</strong></p>
        <p>QR Code sudah diterima admin. Konfirmasi jika sudah membayar:</p>
        <a href="https://wa.me/6281234567890?text=Konfirmasi+pembayaran+QRIS+pesanan+{{ urlencode($pesanan->kode_pesanan ?? '#'.$pesanan->id) }}" target="_blank" class="btn-wa">💬 Konfirmasi via WhatsApp</a>
      </div>
    </div>
    @elseif($isTransfer)
    @php
      $bankInfo = [
        'transfer_bca'     => ['BCA','1234 5678 90'],
        'transfer_bri'     => ['BRI','9876 5432 10'],
        'transfer_mandiri' => ['Mandiri','1122 3344 55'],
        'transfer_bni'     => ['BNI','5566 7788 99'],
      ];
      [$bankNama,$bankRek] = $bankInfo[$pesanan->metode_bayar] ?? ['Bank','-'];
    @endphp
    <div class="info-box blue">
      <div class="ib-icon">🏦</div>
      <div>
        <div class="ib-title">Transfer {{ $bankNama }}</div>
        <div class="bank-detail">
          <div>No. Rekening: <strong>{{ $bankRek }}</strong></div>
          <div>A/N: <strong>Bioaqua Jember</strong></div>
          <div class="bank-total">Nominal: <strong>Rp {{ number_format($pesanan->total_harga,0,',','.') }}</strong></div>
        </div>
        <p>Bukti transfer sudah kamu upload. Admin akan memverifikasi dalam 1×24 jam.</p>
        <a href="https://wa.me/6281234567890?text=Konfirmasi+transfer+{{ $bankNama }}+pesanan+{{ urlencode($pesanan->kode_pesanan ?? '#'.$pesanan->id) }}" target="_blank" class="btn-wa">💬 Konfirmasi via WhatsApp</a>
      </div>
    </div>
    @endif

    <div class="sks-actions">
      <a href="{{ route('pesanan.riwayat') }}" class="btn-riwayat">📋 Lihat Riwayat Pesanan</a>
      <a href="/" class="btn-lanjut">🛒 Lanjut Belanja</a>
    </div>
  </div>

</div>
</div>

<style>
.sks-page { background:transparent; min-height:100vh; display:flex; align-items:center; padding:40px 16px; font-family:'Inter',system-ui,sans-serif; }
.sks-wrap { max-width:540px; margin:0 auto; width:100%; }

.sks-card { background:#fff; border-radius:24px; padding:36px 32px; box-shadow:0 20px 60px rgba(37,99,235,.18); text-align:center; position:relative; overflow:hidden; border:1.5px solid #dbeafe; }
.sks-top-bar { position:absolute; top:0; left:0; right:0; height:4px; background:linear-gradient(90deg,#1e40af,#3b82f6,#60a5fa,#3b82f6,#1e40af); }
.sks-icon  { font-size:3.5rem; margin:16px 0 8px; }
.sks-title { font-size:1.8rem; font-weight:900; color:#1e293b; margin:0 0 8px; }
.sks-sub   { color:#64748b; font-size:.92rem; margin:0 0 22px; line-height:1.6; }

.order-info { background:#f0f7ff; border:1px solid #dbeafe; border-radius:14px; padding:16px 18px; margin-bottom:18px; text-align:left; }
.order-row  { display:flex; justify-content:space-between; align-items:center; padding:8px 0; border-bottom:1px solid #dbeafe; font-size:.85rem; color:#475569; gap:10px; }
.order-row:last-child { border:none; }
.kode-val   { font-family:monospace; color:#1e40af; font-size:.95rem; font-weight:800; }
.total-val  { color:#1e40af; font-size:1rem; font-weight:900; }
.metode-tag { background:#dbeafe; color:#1e40af; font-size:.72rem; font-weight:700; padding:2px 10px; border-radius:99px; }
.status-pill { background:#fef3c7; color:#d97706; padding:3px 12px; border-radius:99px; font-size:.75rem; font-weight:700; white-space:nowrap; }

/* Info boxes */
.info-box { display:flex; gap:14px; text-align:left; border-radius:14px; padding:16px 18px; margin-bottom:20px; }
.info-box.blue  { background:linear-gradient(135deg,#eff6ff,#dbeafe); border:1.5px solid #93c5fd; }
.info-box.green { background:linear-gradient(135deg,#f0fdf4,#dcfce7); border:1.5px solid #86efac; }
.ib-icon { font-size:1.8rem; flex-shrink:0; margin-top:2px; }
.ib-title { font-weight:800; color:#1e293b; margin-bottom:6px; font-size:.92rem; }
.info-box.blue  .ib-title { color:#1e40af; }
.info-box.green .ib-title { color:#15803d; }
.info-box p { font-size:.82rem; color:#475569; margin:0 0 10px; line-height:1.5; }
.bank-detail { background:rgba(255,255,255,.7); border-radius:8px; padding:10px 12px; font-size:.82rem; margin-bottom:10px; line-height:2; color:#1e293b; }
.bank-total { margin-top:4px; font-size:.88rem; }
.btn-wa { display:inline-flex; align-items:center; gap:6px; background:#25d366; color:#fff; padding:8px 18px; border-radius:10px; font-size:.8rem; font-weight:700; text-decoration:none; transition:.2s; }
.btn-wa:hover { background:#1ebe5d; }

.sks-actions { display:flex; flex-direction:column; gap:10px; }
.btn-riwayat { display:block; background:linear-gradient(135deg,#1e40af,#2563eb); color:#fff; padding:14px; border-radius:12px; font-weight:700; text-decoration:none; transition:.2s; font-size:.9rem; }
.btn-riwayat:hover { opacity:.9; transform:translateY(-1px); }
.btn-lanjut  { display:block; background:#f1f5f9; color:#475569; padding:13px; border-radius:12px; font-weight:600; text-decoration:none; transition:.2s; font-size:.88rem; }
.btn-lanjut:hover { background:#e2e8f0; }

/* ===== DARK MODE OVERRIDES ===== */
html.dark-mode .sks-card { background:#16213e !important; border-color:#334155 !important; }
html.dark-mode .sks-title { color:#f1f5f9 !important; }
html.dark-mode .sks-sub,
html.dark-mode .order-row,
html.dark-mode .info-box p { color:#94a3b8 !important; }
html.dark-mode .order-info { background:#0f172a !important; border-color:#334155 !important; }
html.dark-mode .order-row { border-color:#334155 !important; }
html.dark-mode .kode-val,
html.dark-mode .total-val,
html.dark-mode .metode-tag { color:#7dd3fc !important; }
html.dark-mode .metode-tag { background:#1e3a5f !important; }
html.dark-mode .info-box.blue { background:#1e3a5f !important; border-color:#334155 !important; }
html.dark-mode .info-box.green { background:#14532d !important; border-color:#166534 !important; }
html.dark-mode .info-box.blue .ib-title { color:#7dd3fc !important; }
html.dark-mode .info-box.green .ib-title { color:#4ade80 !important; }
html.dark-mode .bank-detail { background:rgba(255,255,255,.06) !important; color:#e2e8f0 !important; }
html.dark-mode .btn-lanjut { background:#0f172a !important; color:#94a3b8 !important; }
html.dark-mode .btn-lanjut:hover { background:#1e2d45 !important; }
</style>
@endsection
