@extends('layouts.app')
@section('title','Riwayat Pesanan')
@section('content')

<div class="rw-page">
<div class="rw-wrap">

  <div class="rw-hero">
    <div>
      <h1>📋 Riwayat Pesanan</h1>
      <p>Semua pesanan yang pernah kamu buat</p>
    </div>
    <a href="/" class="rw-back">🛒 Lanjut Belanja</a>
  </div>

  @if($pesanans->isEmpty())
  <div class="rw-empty">
    <div style="font-size:3rem;margin-bottom:12px;">📭</div>
    <h3>Belum ada pesanan</h3>
    <p>Kamu belum pernah memesan. Yuk belanja sekarang!</p>
    <a href="/" class="btn-shop">🛒 Mulai Belanja</a>
  </div>
  @else
  <div class="rw-tbl-card">
    <div class="rw-tbl-scroll">
    <table class="rw-tbl">
      <thead>
        <tr>
          <th>Kode</th>
          <th>Tanggal</th>
          <th>Produk</th>
          <th>Total</th>
          <th>Metode Bayar</th>
          <th>Status</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        @foreach($pesanans as $p)
        @php
          $statusColors = [
            'menunggu' => ['#d97706','#fef3c7','⏳'],
            'proses'   => ['#2563eb','#dbeafe','🔄'],
            'selesai'  => ['#059669','#d1fae5','✅'],
            'batal'    => ['#dc2626','#fee2e2','❌'],
          ];
          [$sc,$sbg,$sicon] = $statusColors[$p->status] ?? ['#94a3b8','#f1f5f9','📦'];
        @endphp
        <tr>
          <td><span class="rw-kode">{{ $p->kode_pesanan ?? '#'.$p->id }}</span></td>
          <td class="rw-tgl">{{ \Carbon\Carbon::parse($p->tanggal_pesan)->format('d M Y') }}</td>
          <td class="rw-prod" title="{{ $p->nama_produk }}">{{ $p->nama_produk }}</td>
          <td class="rw-total">Rp {{ number_format($p->total_harga,0,',','.') }}</td>
          <td><span class="rw-metode">{{ strtoupper(str_replace('_',' ',$p->metode_bayar ?? '-')) }}</span></td>
          <td><span class="rw-status" style="background:{{ $sbg }};color:{{ $sc }};">{{ $sicon }} {{ ucfirst($p->status) }}</span></td>
          <td><a href="{{ route('pesanan.show',$p) }}" class="rw-detail-btn">Lihat Detail →</a></td>
        </tr>
        @endforeach
      </tbody>
    </table>
    </div>
    @if($pesanans->hasPages())
    <div class="rw-pager">{{ $pesanans->links() }}</div>
    @endif
  </div>
  @endif

</div>
</div>

<style>
.rw-page { background:transparent; min-height:100vh; padding:28px 16px 48px; font-family:'Inter',system-ui,sans-serif; }
.rw-wrap { max-width:1100px; margin:0 auto; }

.rw-hero { display:flex; justify-content:space-between; align-items:center; background:linear-gradient(135deg,#1e40af,#2563eb,#3b82f6); border-radius:18px; padding:22px 28px; margin-bottom:22px; color:#fff; box-shadow:0 8px 28px rgba(37,99,235,.35); }
.rw-hero h1 { font-size:1.5rem; font-weight:800; margin:0 0 4px; }
.rw-hero p  { opacity:.75; font-size:.88rem; margin:0; }
.rw-back { background:rgba(255,255,255,.15); border:1px solid rgba(255,255,255,.3); color:#fff; padding:9px 18px; border-radius:10px; text-decoration:none; font-size:.85rem; font-weight:600; transition:.2s; white-space:nowrap; }
.rw-back:hover { background:rgba(255,255,255,.25); }

.rw-empty { background:#fff; border-radius:20px; padding:48px; text-align:center; box-shadow:0 8px 32px rgba(37,99,235,.1); border:1px solid #dbeafe; }
.rw-empty h3 { font-size:1.2rem; font-weight:700; color:#1e293b; margin:0 0 8px; }
.rw-empty p  { color:#94a3b8; margin:0 0 20px; }
.btn-shop { display:inline-block; background:linear-gradient(135deg,#1e40af,#2563eb); color:#fff; padding:12px 28px; border-radius:12px; font-weight:700; text-decoration:none; }

/* TABLE */
.rw-tbl-card { background:#fff; border:1.5px solid #dbeafe; border-radius:20px; overflow:hidden; box-shadow:0 4px 20px rgba(37,99,235,.08); }
.rw-tbl-scroll { overflow-x:auto; }
.rw-tbl { width:100%; border-collapse:collapse; }
.rw-tbl thead tr { background:linear-gradient(135deg,#1e40af,#2563eb); }
.rw-tbl th { padding:14px 14px; font-size:.77rem; font-weight:700; color:#fff; text-align:left; white-space:nowrap; letter-spacing:.03em; }
.rw-tbl tbody tr { border-bottom:1px solid #f1f5f9; transition:.15s; }
.rw-tbl tbody tr:hover { background:#f0f7ff; }
.rw-tbl td { padding:12px 14px; vertical-align:middle; font-size:.85rem; }

.rw-kode { font-family:monospace; font-weight:700; font-size:.8rem; color:#1e40af; background:#dbeafe; padding:3px 10px; border-radius:6px; white-space:nowrap; }
.rw-tgl { color:#64748b; font-size:.78rem; white-space:nowrap; }
.rw-prod { color:#475569; max-width:200px; overflow:hidden; text-overflow:ellipsis; white-space:nowrap; }
.rw-total { color:#1e40af; font-weight:800; white-space:nowrap; }
.rw-metode { font-size:.72rem; background:#dbeafe; color:#1e40af; padding:2px 8px; border-radius:99px; font-weight:700; white-space:nowrap; }
.rw-status { font-size:.75rem; font-weight:700; padding:4px 12px; border-radius:99px; white-space:nowrap; }
.rw-detail-btn { display:inline-flex; align-items:center; gap:6px; background:linear-gradient(135deg,#1e40af,#2563eb); color:#fff; padding:7px 14px; border-radius:8px; text-decoration:none; font-size:.78rem; font-weight:700; transition:.2s; white-space:nowrap; }
.rw-detail-btn:hover { opacity:.88; }

.rw-pager { padding:14px 20px; border-top:1px solid #f1f5f9; }

/* DARK MODE */
.dark-mode .rw-tbl-card { background:#16213e !important; border-color:#334155 !important; }
.dark-mode .rw-tbl tbody tr { border-color:#334155 !important; }
.dark-mode .rw-tbl tbody tr:hover { background:#1e3a5f !important; }
.dark-mode .rw-prod { color:#cbd5e1 !important; }
.dark-mode .rw-tgl { color:#94a3b8 !important; }
.dark-mode .rw-pager { border-color:#334155 !important; }
.dark-mode .rw-empty { background:#16213e !important; border-color:#334155 !important; }
.dark-mode .rw-empty h3 { color:#f1f5f9 !important; }
.dark-mode .rw-kode { background:#1e3a5f !important; color:#7dd3fc !important; }
.dark-mode .rw-total { color:#7dd3fc !important; }
.dark-mode .rw-metode { background:#1e3a5f !important; color:#7dd3fc !important; }
.dark-mode .rw-status {
  background:rgba(255,255,255,.08) !important;
  filter:none !important;
}
.dark-mode .rw-status[style*="2563eb"],
.dark-mode .rw-status[style*="dbeafe"] { color:#93c5fd !important; background:#1e3a5f !important; }
.dark-mode .rw-status[style*="d97706"],
.dark-mode .rw-status[style*="fef3c7"] { color:#fcd34d !important; background:#78350f !important; }
.dark-mode .rw-status[style*="059669"],
.dark-mode .rw-status[style*="d1fae5"] { color:#86efac !important; background:#14532d !important; }
.dark-mode .rw-status[style*="dc2626"],
.dark-mode .rw-status[style*="fee2e2"] { color:#fca5a5 !important; background:#7f1d1d !important; }

@media(max-width:768px){
  .rw-tbl th, .rw-tbl td { font-size:.78rem; padding:10px 10px; }
  .rw-prod { max-width:120px; }
}
</style>
@endsection
