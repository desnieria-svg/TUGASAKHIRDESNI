<?php $__env->startSection('title','Checkout'); ?>
<?php $__env->startSection('content'); ?>

<div class="co-page">
<div class="co-wrap">

  
  <div class="co-header">
    <a href="/" class="co-back">
      <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M19 12H5M12 5l-7 7 7 7"/></svg>
      Kembali Belanja
    </a>
    <div class="co-header-text">
      <h1>🛒 Checkout</h1>
      <p>Lengkapi data dan selesaikan pesanan kamu</p>
    </div>
    
    <div class="co-steps">
      <div class="step active"><span class="step-num">1</span><span class="step-lbl">Data</span></div>
      <div class="step-line"></div>
      <div class="step active"><span class="step-num">2</span><span class="step-lbl">Pengiriman</span></div>
      <div class="step-line"></div>
      <div class="step active"><span class="step-num">3</span><span class="step-lbl">Bayar</span></div>
    </div>
  </div>

  <form action="<?php echo e(route('pesanan.store')); ?>" method="POST" id="checkoutForm" enctype="multipart/form-data">
    <?php echo csrf_field(); ?>
    <input type="hidden" name="items" id="itemsInput">

    <div class="co-grid">

      
      <div class="co-left">

        
        <div class="co-card">
          <div class="co-card-head">
            <span class="co-card-icon">📦</span>
            <h3>Produk Dipesan</h3>
          </div>
          <div id="coItems"><p class="empty-cart">Keranjang kamu kosong.</p></div>
          <div class="co-total-bar">
            <span>Total Pembayaran</span>
            <strong id="coTotal">Rp 0</strong>
          </div>
        </div>

        
        <div class="co-card">
          <div class="co-card-head"><span class="co-card-icon">👤</span><h3>Data Penerima</h3></div>
          <div class="fg-row">
            <div class="fg">
              <label class="lbl">Nama Lengkap <span class="req">*</span></label>
              <input name="nama_pelanggan" value="<?php echo e(auth()->user()->name); ?>" class="inp" placeholder="Nama penerima" required>
              <?php $__errorArgs = ['nama_pelanggan'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="err"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
            <div class="fg">
              <label class="lbl">No. WhatsApp <span class="req">*</span></label>
              <input name="no_hp" class="inp" placeholder="08xxxxxxxxxx" required>
              <?php $__errorArgs = ['no_hp'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="err"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
          </div>
          <div class="fg" style="margin-top:14px">
            <label class="lbl">Catatan (opsional)</label>
            <input name="catatan" class="inp" placeholder="Misal: titip di satpam, hubungi sebelum sampai, dll">
          </div>
        </div>

        
        <div class="co-card">
          <div class="co-card-head"><span class="co-card-icon">🚚</span><h3>Metode Pengiriman</h3></div>
          <div class="delivery-opts">
            <label class="dlv-card selected" id="opt-antar">
              <input type="radio" name="jenis_pengiriman" value="antar" checked hidden>
              <div class="dlv-inner">
                <div class="dlv-icon">🚐</div>
                <div>
                  <div class="dlv-title">Diantar ke Alamat</div>
                  <div class="dlv-sub">Kami antar ke lokasi kamu di Jember</div>
                </div>
                <div class="dlv-check">✓</div>
              </div>
            </label>
            <label class="dlv-card" id="opt-jemput">
              <input type="radio" name="jenis_pengiriman" value="jemput" hidden>
              <div class="dlv-inner">
                <div class="dlv-icon">🏪</div>
                <div>
                  <div class="dlv-title">Ambil Sendiri (Jemput)</div>
                  <div class="dlv-sub">Datang langsung ke toko kami</div>
                </div>
                <div class="dlv-check">✓</div>
              </div>
            </label>
          </div>

          
          <div id="alamatBlock">
            <div class="alamat-divider">📍 Alamat Pengiriman di Jember</div>
            <div class="fg">
              <label class="lbl">Kecamatan <span class="req">*</span></label>
              <select name="kecamatan" id="selKecamatan" class="inp" required>
                <option value="">-- Pilih Kecamatan --</option>
                <?php
                $kecamatans = [
                  'Ajung','Ambulu','Arjasa','Balung','Bangsalsari','Gumukmas',
                  'Jelbuk','Jenggawah','Jombang','Kalisat','Kaliwates','Kencong',
                  'Ledokombo','Mayang','Mumbulsari','Pakusari','Panti','Patrang',
                  'Puger','Rambipuji','Semboro','Silo','Sukorambi','Sukowono',
                  'Sumberbaru','Sumberjambe','Sumbersari','Tanggul','Tempurejo',
                  'Umbulsari','Wuluhan'
                ];
                ?>
                <?php $__currentLoopData = $kecamatans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($k); ?>"><?php echo e($k); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </select>
              <?php $__errorArgs = ['kecamatan'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="err"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
            <div class="fg" style="margin-top:12px">
              <label class="lbl">Kelurahan / Desa <span class="req">*</span></label>
              <select name="kelurahan" id="selKelurahan" class="inp" required>
                <option value="">-- Pilih Kecamatan dulu --</option>
              </select>
              <?php $__errorArgs = ['kelurahan'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="err"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
            <div class="fg-row" style="margin-top:12px">
              <div class="fg">
                <label class="lbl">RT / RW <span class="req">*</span></label>
                <input name="rt_rw" class="inp" placeholder="001/002" required id="rtRwInp">
                <?php $__errorArgs = ['rt_rw'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="err"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
              </div>
            </div>
            <div class="fg" style="margin-top:12px">
              <label class="lbl">Alamat Lengkap <span class="req">*</span></label>
              <textarea name="alamat" class="inp" rows="2" placeholder="Nama jalan, nomor rumah, patokan, dll" required id="alamatInp"></textarea>
              <?php $__errorArgs = ['alamat'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="err"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
          </div>

        </div>

      </div>

      
      <div class="co-right">
        <div class="co-sticky">

          <div class="co-card">
            <div class="co-card-head"><span class="co-card-icon">💳</span><h3>Metode Pembayaran</h3></div>

            
            <div class="pay-group">
              <div class="pay-group-lbl">📱 QRIS</div>
              <label class="pay-card selected" data-method="qris">
                <input type="radio" name="metode_bayar" value="qris" checked hidden>
                <div class="pay-inner">
                  <div class="pay-logo" style="background:linear-gradient(135deg,#0ea5e9,#0284c7);border-radius:10px;padding:6px 10px;">
                    <svg viewBox="0 0 60 24" width="52" height="20"><rect width="60" height="24" rx="4" fill="transparent"/><text x="50%" y="50%" dominant-baseline="middle" text-anchor="middle" font-size="11" font-weight="900" fill="white" font-family="Arial">QRIS</text></svg>
                  </div>
                  <div>
                    <div class="pay-name">QRIS</div>
                    <div class="pay-sub">Scan QR dengan aplikasi apapun</div>
                  </div>
                  <div class="pay-check-ic">✓</div>
                </div>
              </label>
            </div>

            
            <div class="pay-group">
              <div class="pay-group-lbl">🏦 Transfer Bank</div>
              <label class="pay-card" data-method="transfer_bca">
                <input type="radio" name="metode_bayar" value="transfer_bca" hidden>
                <div class="pay-inner">
                  <div class="pay-logo bank-logo" style="background:#003087;">BCA</div>
                  <div>
                    <div class="pay-name">Transfer BCA</div>
                    <div class="pay-sub">No. Rek: 1234567890 a/n Bioaqua</div>
                  </div>
                  <div class="pay-check-ic">✓</div>
                </div>
              </label>
              <label class="pay-card" data-method="transfer_bri">
                <input type="radio" name="metode_bayar" value="transfer_bri" hidden>
                <div class="pay-inner">
                  <div class="pay-logo bank-logo" style="background:#003087;">BRI</div>
                  <div>
                    <div class="pay-name">Transfer BRI</div>
                    <div class="pay-sub">No. Rek: 9876543210 a/n Bioaqua</div>
                  </div>
                  <div class="pay-check-ic">✓</div>
                </div>
              </label>
              <label class="pay-card" data-method="transfer_mandiri">
                <input type="radio" name="metode_bayar" value="transfer_mandiri" hidden>
                <div class="pay-inner">
                  <div class="pay-logo bank-logo" style="background:#003087;">Mandiri</div>
                  <div>
                    <div class="pay-name">Transfer Mandiri</div>
                    <div class="pay-sub">No. Rek: 1122334455 a/n Bioaqua</div>
                  </div>
                  <div class="pay-check-ic">✓</div>
                </div>
              </label>
            </div>

            
            <div class="pay-group">
              <div class="pay-group-lbl">💵 Bayar di Tempat</div>
              <label class="pay-card" data-method="cod">
                <input type="radio" name="metode_bayar" value="cod" hidden>
                <div class="pay-inner">
                  <div class="pay-logo" style="background:#16a34a;border-radius:10px;padding:6px 10px;">
                    <svg viewBox="0 0 24 24" fill="none" width="22" height="22"><rect x="2" y="5" width="20" height="14" rx="3" stroke="white" stroke-width="1.8"/><path d="M2 10h20" stroke="white" stroke-width="1.8"/><circle cx="7" cy="15" r="1.2" fill="white"/></svg>
                  </div>
                  <div>
                    <div class="pay-name">COD (Cash on Delivery)</div>
                    <div class="pay-sub">Bayar tunai saat barang diterima</div>
                  </div>
                  <div class="pay-check-ic">✓</div>
                </div>
              </label>
            </div>

            
            <div id="paymentDetail" class="payment-detail-box">
              <div class="pd-title">💰 Total yang Harus Dibayar</div>
              <div class="pd-amount" id="pdAmount">Rp 0</div>
              <div id="pdInstructions" class="pd-instructions"></div>
            </div>

            
            <div id="buktiBlock" class="bukti-block">
              <div class="bukti-label">
                <span>📎 Upload Bukti Pembayaran</span>
                <span class="bukti-req">Wajib</span>
              </div>
              <label class="bukti-dropzone" id="buktiDropzone">
                <input type="file" name="bukti_bayar" id="buktiBayarInp" accept="image/*,.pdf" style="display:none">
                <div id="buktiPreviewWrap">
                  <div class="bukti-icon">📷</div>
                  <div class="bukti-hint">Klik atau drag foto bukti transfer / screenshot</div>
                  <div class="bukti-hint2">JPG, PNG, PDF — maks 5MB</div>
                </div>
                <img id="buktiPreviewImg" src="" alt="Preview" style="display:none;max-width:100%;border-radius:10px;max-height:180px;object-fit:contain;">
              </label>
              <p class="bukti-note">Admin akan memverifikasi pembayaran kamu dalam 1×24 jam</p>
              <?php $__errorArgs = ['bukti_bayar'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="err"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

          </div>

          
          <div class="summary-box">
            <div class="summary-row"><span>Subtotal</span><span id="sumSubtotal">Rp 0</span></div>
            <div class="summary-row"><span>Pengiriman</span><span id="sumOngkir" class="green-txt">Gratis</span></div>
            <div class="summary-total"><span>Total</span><strong id="sumTotal">Rp 0</strong></div>
          </div>

          <button type="submit" class="btn-bayar" id="btnBayar">
            <span id="btnTxt">✅ Konfirmasi Pesanan</span>
          </button>
          <p class="secure-note">🔒 Transaksi aman & terverifikasi admin</p>

        </div>
      </div>

    </div>
  </form>

</div>
</div>

<style>
/* ===== BASE ===== */
.co-page { background:transparent; min-height:100vh; padding:28px 16px 40px; font-family:'Inter',system-ui,sans-serif; }
.co-wrap { max-width:1100px; margin:0 auto; }

/* ===== HEADER ===== */
.co-header { background:linear-gradient(135deg,#1e40af,#2563eb,#3b82f6); border-radius:20px; padding:24px 28px; margin-bottom:24px; color:#fff; box-shadow:0 8px 28px rgba(37,99,235,.35); }
.co-back   { display:inline-flex; align-items:center; gap:6px; color:rgba(255,255,255,0.85); text-decoration:none; font-size:0.85rem; font-weight:600; margin-bottom:14px; transition:.2s; }
.co-back:hover { color:#fff; }
.co-header-text h1 { font-size:1.7rem; font-weight:800; margin:0 0 4px; }
.co-header-text p  { margin:0 0 18px; opacity:.8; font-size:.9rem; }

/* Steps */
.co-steps { display:flex; align-items:center; }
.step { display:flex; align-items:center; gap:8px; }
.step-num { width:30px; height:30px; border-radius:50%; background:rgba(255,255,255,.25); color:#fff; font-weight:700; font-size:.85rem; display:flex; align-items:center; justify-content:center; }
.step.active .step-num { background:#fff; color:#1e40af; }
.step-lbl { font-size:.8rem; font-weight:600; opacity:.8; }
.step.active .step-lbl { opacity:1; }
.step-line { flex:1; min-width:30px; height:2px; background:rgba(255,255,255,.3); margin:0 8px; }

/* ===== GRID ===== */
.co-grid { display:grid; grid-template-columns:1fr 390px; gap:20px; }
@media(max-width:900px){ .co-grid { grid-template-columns:1fr; } }

/* ===== CARDS ===== */
.co-card { background:#fff; border-radius:18px; padding:22px; box-shadow:0 4px 20px rgba(37,99,235,.08); border:1px solid #dbeafe; margin-bottom:16px; }
.co-card-head { display:flex; align-items:center; gap:10px; margin-bottom:18px; }
.co-card-head h3 { font-size:.95rem; font-weight:700; color:#1e293b; margin:0; }
.co-card-icon { font-size:1.2rem; }

/* ===== FORMS ===== */
.fg-row { display:grid; grid-template-columns:1fr 1fr; gap:14px; }
.fg { display:flex; flex-direction:column; }
.lbl { font-size:.8rem; font-weight:600; color:#374151; margin-bottom:5px; }
.req { color:#ef4444; }
.inp { padding:10px 14px; border:1.5px solid #dbeafe; border-radius:10px; font-size:.88rem; outline:none; transition:.2s; font-family:inherit; resize:vertical; background:#fff; color:#1e293b; }
.inp:focus { border-color:#2563eb; box-shadow:0 0 0 3px rgba(37,99,235,.12); }
.err { color:#ef4444; font-size:.73rem; margin:4px 0 0; }
.empty-cart { color:#94a3b8; text-align:center; padding:20px 0; margin:0; }

/* ===== TOTAL ===== */
.co-total-bar { display:flex; justify-content:space-between; align-items:center; padding-top:14px; border-top:2px dashed #dbeafe; margin-top:14px; }
.co-total-bar strong { font-size:1.2rem; font-weight:800; color:#2563eb; }

/* ===== DELIVERY ===== */
.delivery-opts { display:flex; flex-direction:column; gap:10px; margin-bottom:16px; }
.dlv-card { display:block; cursor:pointer; }
.dlv-inner { display:flex; align-items:center; gap:14px; padding:14px 16px; border:2px solid #dbeafe; border-radius:14px; transition:.2s; background:#f0f7ff; }
.dlv-card.selected .dlv-inner { border-color:#2563eb; background:linear-gradient(135deg,#eff6ff,#dbeafe); box-shadow:0 0 0 3px rgba(37,99,235,.12); }
.dlv-icon { font-size:1.8rem; }
.dlv-title { font-weight:700; font-size:.9rem; color:#1e293b; }
.dlv-sub { font-size:.75rem; color:#94a3b8; margin-top:2px; }
.dlv-check { margin-left:auto; width:24px; height:24px; border-radius:50%; background:#2563eb; color:#fff; font-size:.75rem; display:none; align-items:center; justify-content:center; }
.dlv-card.selected .dlv-check { display:flex; }
.alamat-divider { font-size:.8rem; font-weight:700; color:#2563eb; margin:16px 0 12px; padding:8px 14px; background:linear-gradient(135deg,#eff6ff,#dbeafe); border-radius:8px; border-left:3px solid #2563eb; }

/* ===== PAYMENT ===== */
.pay-group { margin-bottom:14px; }
.pay-group-lbl { font-size:.72rem; font-weight:700; color:#64748b; text-transform:uppercase; letter-spacing:.07em; margin-bottom:7px; padding-bottom:4px; border-bottom:1px solid #e2e8f0; }
.pay-card { display:block; cursor:pointer; margin-bottom:6px; }
.pay-inner { display:flex; align-items:center; gap:12px; padding:11px 14px; border:2px solid #dbeafe; border-radius:12px; transition:.2s; background:#f8faff; }
.pay-card.selected .pay-inner { border-color:#2563eb; background:linear-gradient(135deg,#eff6ff,#dbeafe); box-shadow:0 0 0 3px rgba(37,99,235,.12); }
.pay-logo { display:flex; align-items:center; justify-content:center; min-width:60px; color:#fff; font-size:.72rem; font-weight:800; border-radius:10px; padding:6px 10px; min-height:36px; white-space:nowrap; }
.bank-logo { background:linear-gradient(135deg,#1e40af,#2563eb); font-size:.75rem; }
.pay-name { font-size:.85rem; font-weight:600; color:#1e293b; }
.pay-sub  { font-size:.73rem; color:#94a3b8; margin-top:1px; }
.pay-check-ic { margin-left:auto; width:22px; height:22px; border-radius:50%; background:#2563eb; color:#fff; font-size:.7rem; display:none; align-items:center; justify-content:center; flex-shrink:0; }
.pay-card.selected .pay-check-ic { display:flex; }

/* ===== PAYMENT DETAIL BOX ===== */
.payment-detail-box { background:linear-gradient(135deg,#1e40af,#2563eb); border-radius:14px; padding:16px 18px; margin:14px 0; color:#fff; }
.pd-title { font-size:.78rem; font-weight:600; opacity:.85; margin-bottom:6px; }
.pd-amount { font-size:1.6rem; font-weight:900; letter-spacing:-.01em; margin-bottom:10px; }
.pd-instructions { font-size:.8rem; background:rgba(255,255,255,.15); border-radius:10px; padding:10px 12px; line-height:1.6; }
.pd-instructions strong { display:block; margin-bottom:4px; font-size:.82rem; }

/* ===== BUKTI BAYAR ===== */
.bukti-block { margin-top:14px; }
.bukti-label { display:flex; justify-content:space-between; align-items:center; margin-bottom:8px; font-size:.82rem; font-weight:700; color:#1e293b; }
.bukti-req { background:#fee2e2; color:#dc2626; font-size:.7rem; padding:2px 8px; border-radius:99px; font-weight:700; }
.bukti-dropzone { display:block; border:2px dashed #93c5fd; border-radius:14px; padding:20px; text-align:center; cursor:pointer; transition:.2s; background:#f0f7ff; }
.bukti-dropzone:hover { border-color:#2563eb; background:#eff6ff; }
.bukti-dropzone.has-file { border-color:#2563eb; background:#eff6ff; border-style:solid; }
.bukti-icon { font-size:2rem; margin-bottom:8px; }
.bukti-hint { font-size:.8rem; font-weight:600; color:#2563eb; margin-bottom:4px; }
.bukti-hint2 { font-size:.72rem; color:#94a3b8; }
.bukti-note { font-size:.72rem; color:#64748b; text-align:center; margin-top:8px; margin-bottom:0; }

/* ===== STICKY KANAN ===== */
.co-sticky { position:sticky; top:80px; }
.co-right .co-card { margin-bottom:14px; }

/* ===== SUMMARY ===== */
.summary-box { background:linear-gradient(135deg,#eff6ff,#dbeafe); border:1.5px solid #93c5fd; border-radius:14px; padding:16px 18px; margin-bottom:14px; }
.summary-row { display:flex; justify-content:space-between; font-size:.85rem; color:#64748b; padding:5px 0; }
.green-txt { color:#059669; font-weight:600; }
.summary-total { display:flex; justify-content:space-between; padding-top:10px; border-top:2px solid #93c5fd; margin-top:6px; font-size:1rem; color:#1e293b; }
.summary-total strong { font-size:1.25rem; font-weight:800; color:#1e40af; }

/* ===== BUTTON ===== */
.btn-bayar { width:100%; background:linear-gradient(135deg,#1e40af,#2563eb); color:#fff; border:none; padding:15px; border-radius:14px; font-size:1rem; font-weight:700; cursor:pointer; transition:.2s; box-shadow:0 6px 20px rgba(37,99,235,.35); letter-spacing:.02em; font-family:inherit; }
.btn-bayar:hover { opacity:.92; transform:translateY(-2px); box-shadow:0 8px 28px rgba(37,99,235,.45); }
.secure-note { text-align:center; font-size:.73rem; color:#94a3b8; margin-top:10px; }

/* ===== ITEMS ===== */
.co-item { display:flex; align-items:center; gap:12px; padding:11px 0; border-bottom:1px solid #f1f5f9; }
.co-item:last-child { border:none; }
.co-item-thumb { width:52px; height:52px; border-radius:10px; object-fit:cover; border:1px solid #dbeafe; }
.co-item-thumb-icon { width:52px; height:52px; border-radius:10px; background:linear-gradient(135deg,#dbeafe,#eff6ff); display:flex; align-items:center; justify-content:center; font-size:1.5rem; }
.co-item-name  { font-size:.88rem; font-weight:600; color:#1e293b; }
.co-item-cat   { font-size:.73rem; color:#94a3b8; }
.co-item-price { font-size:.88rem; font-weight:700; color:#2563eb; }
.co-item-qty   { font-size:.75rem; color:#64748b; }
</style>

<script>
// ===================== DATA KELURAHAN =====================
const kelurahanData = {
  'Ajung': ['Ajung','Klompangan','Mangaran','Pancakarya','Wirolegi','Sukamakmur','Pondokrejo','Rambutan'],
  'Ambulu': ['Ambulu','Andongsari','Karang Anyar','Pontang','Sabrang','Sumberejo','Tegalsari','Wotgalih'],
  'Arjasa': ['Arjasa','Candijati','Darsono','Gebang','Kemuning Lor','Biting','Slawu','Mrawan'],
  'Balung': ['Balung Kulon','Balung Lor','Balung Tengah','Gumelar','Karangduren','Pucanganom','Tutul','Bagon'],
  'Bangsalsari': ['Bangsalsari','Banjarsari','Curahkalong','Gambirono','Langkap','Petung','Sukorejo','Tugusari'],
  'Gumukmas': ['Gumukmas','Kepanjen','Menampu','Paseban','Purwoasri','Tembokrejo','Karangrejo','Purwodadi'],
  'Jelbuk': ['Jelbuk','Sumberjati','Sukowiryo','Sucopangepok','Panduman','Suger Kidul','Suger Lor'],
  'Jenggawah': ['Jenggawah','Jatisari','Kertonegoro','Kranjingan','Mayangan','Sruni','Wonojati','Rowotengah'],
  'Jombang': ['Jombang','Kencong','Kraton','Paseban','Sumberagung'],
  'Kalisat': ['Kalisat','Gambiran','Glagah','Paleran','Patempuran','Sukorejo','Sumberbulus','Plalangan'],
  'Kaliwates': ['Kaliwates','Kebon Agung','Kepatihan','Mangli','Sempusari','Tegal Besar'],
  'Kencong': ['Kencong','Cakru','Kraton','Plerean','Rowotengah','Wonorejo'],
  'Ledokombo': ['Ledokombo','Sumbersalak','Sumberbulus','Slateng','Lembengan','Sukogidri','Karang Paiton','Sumberlesung'],
  'Mayang': ['Mayang','Tegalwaru','Sidomukti','Tegalrejo','Mrawan','Seputih'],
  'Mumbulsari': ['Mumbulsari','Lampeji','Lengkong','Suco','Sumber Kalong','Tamansari','Jejama','Rowo Indah'],
  'Pakusari': ['Pakusari','Bedadung','Glagahwero','Kertosari','Patemon','Subo','Sumberjeruk'],
  'Panti': ['Panti','Serut','Kemiri','Suci','Pakis','Glagahwero','Sucopangepok'],
  'Patrang': ['Patrang','Gebang Poreng','Jember Lor','Kebonsari','Slawu','Baratan','Bintoro','Bangsalsari'],
  'Puger': ['Puger Kulon','Puger Wetan','Mojomulyo','Mlokorejo','Grenden','Wonoasri','Bagon','Lojejer','Wringintelu'],
  'Rambipuji': ['Rambipuji','Curahmalang','Gugut','Kaliwining','Pecoro','Rambigundam','Rowotamtu'],
  'Semboro': ['Semboro','Pondokdalam','Sidomekar','Sidomulyo','Rejoagung'],
  'Silo': ['Silo','Mulyorejo','Pace','Harjomulyo','Karangharjo','Sempolan','Sucu'],
  'Sumberbaru': ['Sumberbaru','Gelang','Jamintoro','Jatiroto','Karang Bayat','Klompangan','Rowotengah','Sumberagung'],
  'Sukorambi': ['Sukorambi','Klungkung','Panti','Jubung','Karang Paiton'],
  'Sukowono': ['Sukowono','Arjasa','Dawuan','Kalisat','Pocangan','Sumber Kalong','Sukokerto','Mojogemi'],
  'Sumberjambe': ['Sumberjambe','Sumberpakem','Rowosari','Pringgondani','Jambearum','Gunungsari','Karang Paiton'],
  'Sumbersari': ['Sumbersari','Karangrejo','Kebonsari','Wirolegi','Antirogo','Tegalgede'],
  'Tanggul': ['Tanggul Kulon','Tanggul Wetan','Klatakan','Manggisan','Patemon','Selodakon','Kramat'],
  'Tempurejo': ['Tempurejo','Pondokrejo','Curahnongko','Andongrejo','Sanenrejo','Wonoasri','Sidodadi'],
  'Umbulsari': ['Umbulsari','Gadingrejo','Gunungsari','Mundurejo','Paleran','Tanjungrejo','Tegal Wangi'],
  'Wuluhan': ['Glundengan','Kesilir','Lojejer','Tamansari','Tanjungrejo','Wuluhan','Ampelgading'],
};

const paymentInstructions = {
  qris: {
    title: 'QRIS',
    detail: '<strong>Scan QR Code di bawah ini:</strong>QR Code akan dikirim via WhatsApp setelah konfirmasi pesanan. Bisa dibayar via GoPay, OVO, Dana, ShopeePay, dan semua e-wallet.',
  },
  transfer_bca: {
    title: 'Transfer BCA',
    detail: '<strong>Rekening BCA:</strong>No. Rek: <b>1234 5678 90</b><br>A/N: <b>Bioaqua Jember</b><br>Pastikan nominal sesuai total pesanan.',
  },
  transfer_bri: {
    title: 'Transfer BRI',
    detail: '<strong>Rekening BRI:</strong>No. Rek: <b>9876 5432 10</b><br>A/N: <b>Bioaqua Jember</b><br>Pastikan nominal sesuai total pesanan.',
  },
  transfer_mandiri: {
    title: 'Transfer Mandiri',
    detail: '<strong>Rekening Mandiri:</strong>No. Rek: <b>1122 3344 55</b><br>A/N: <b>Bioaqua Jember</b><br>Pastikan nominal sesuai total pesanan.',
  },
  cod: {
    title: 'COD',
    detail: '<strong>Bayar saat barang tiba</strong>Siapkan uang pas atau uang kembalian. Admin akan menghubungi kamu sebelum pengiriman.',
  },
};

document.addEventListener('DOMContentLoaded', function () {

  // ===== CART =====
  const stored = localStorage.getItem('bioaqua_cart');
  const cart   = stored ? JSON.parse(stored) : {};
  const items  = Object.values(cart).filter(i => i.qty > 0);
  const icons  = { galon:'💧', botol:'🍶', jerigen:'🪣', cup:'🥤' };
  let total = 0;

  const coItems = document.getElementById('coItems');
  if (items.length) {
    coItems.innerHTML = '';
    items.forEach(item => {
      total += item.harga * item.qty;
      const d = document.createElement('div');
      d.className = 'co-item';
      d.innerHTML = (item.foto
        ? `<img src="${item.foto}" class="co-item-thumb">`
        : `<div class="co-item-thumb-icon">${icons[item.kategori]||'📦'}</div>`)
        + `<div style="flex:1">
             <div class="co-item-name">${item.nama}</div>
             <div class="co-item-cat">${item.kategori||''}</div>
           </div>
           <div style="text-align:right">
             <div class="co-item-price">Rp ${(item.harga*item.qty).toLocaleString('id-ID')}</div>
             <div class="co-item-qty">${item.qty}× Rp ${item.harga.toLocaleString('id-ID')}</div>
           </div>`;
      coItems.appendChild(d);
    });
  }

  const fmt = v => 'Rp ' + v.toLocaleString('id-ID');
  document.getElementById('coTotal').textContent = fmt(total);
  document.getElementById('sumSubtotal').textContent = fmt(total);
  document.getElementById('sumTotal').textContent = fmt(total);
  document.getElementById('itemsInput').value = JSON.stringify(items);
  document.getElementById('pdAmount').textContent = fmt(total);

  // ===== DELIVERY =====
  const dlvCards   = document.querySelectorAll('.dlv-card');
  const alamatBlock = document.getElementById('alamatBlock');
  const rtRwInp    = document.getElementById('rtRwInp');
  const alamatInp  = document.getElementById('alamatInp');

  function setDelivery(val) {
    dlvCards.forEach(c => {
      const inp = c.querySelector('input[type=radio]');
      c.classList.toggle('selected', inp.value === val);
    });
    const isAntar = val === 'antar';
    alamatBlock.style.display = isAntar ? 'block' : 'none';
    document.getElementById('selKecamatan').required = isAntar;
    document.getElementById('selKelurahan').required = isAntar;
    rtRwInp.required  = isAntar;
    alamatInp.required = isAntar;
    document.getElementById('sumOngkir').textContent = isAntar ? 'Gratis' : '-';
    document.getElementById('sumOngkir').className   = isAntar ? 'green-txt' : '';
  }

  dlvCards.forEach(c => {
    c.addEventListener('click', () => {
      const val = c.querySelector('input[type=radio]').value;
      c.querySelector('input[type=radio]').checked = true;
      setDelivery(val);
    });
  });
  setDelivery('antar');

  // ===== KECAMATAN -> KELURAHAN =====
  const selKec = document.getElementById('selKecamatan');
  const selKel = document.getElementById('selKelurahan');
  selKec.addEventListener('change', function () {
    const kec = this.value;
    const opts = kelurahanData[kec] || [];
    selKel.innerHTML = '<option value="">-- Pilih Kelurahan --</option>';
    opts.forEach(k => {
      const o = document.createElement('option');
      o.value = k; o.textContent = k;
      selKel.appendChild(o);
    });
  });

  // ===== PAYMENT =====
  const payCards   = document.querySelectorAll('.pay-card');
  const buktiBlock = document.getElementById('buktiBlock');
  const buktiInp   = document.getElementById('buktiBayarInp');

  function updatePayment(method) {
    payCards.forEach(x => x.classList.remove('selected'));
    document.querySelector(`.pay-card[data-method="${method}"]`).classList.add('selected');
    document.querySelector(`.pay-card[data-method="${method}"] input[type=radio]`).checked = true;

    const isCod = method === 'cod';
    buktiBlock.style.display = isCod ? 'none' : 'block';
    buktiInp.required = !isCod;

    const info = paymentInstructions[method] || paymentInstructions.qris;
    document.getElementById('pdInstructions').innerHTML = info.detail;
    document.getElementById('pdAmount').textContent = fmt(total);

    const labels = {
      qris: '📱 Bayar via QRIS',
      transfer_bca: '🏦 Bayar via Transfer BCA',
      transfer_bri: '🏦 Bayar via Transfer BRI',
      transfer_mandiri: '🏦 Bayar via Transfer Mandiri',
      cod: '💵 Pesan — Bayar di Tempat',
    };
    document.getElementById('btnTxt').textContent = labels[method] || '✅ Konfirmasi Pesanan';
  }

  payCards.forEach(c => {
    c.addEventListener('click', function () {
      updatePayment(this.dataset.method);
    });
  });
  updatePayment('qris');

  // ===== BUKTI PREVIEW =====
  const dropzone   = document.getElementById('buktiDropzone');
  const previewImg = document.getElementById('buktiPreviewImg');
  const previewWrap = document.getElementById('buktiPreviewWrap');

  buktiInp.addEventListener('change', function () {
    const file = this.files[0];
    if (!file) return;
    dropzone.classList.add('has-file');
    if (file.type.startsWith('image/')) {
      const reader = new FileReader();
      reader.onload = e => {
        previewImg.src = e.target.result;
        previewImg.style.display = 'block';
        previewWrap.style.display = 'none';
      };
      reader.readAsDataURL(file);
    } else {
      previewWrap.querySelector('.bukti-hint').textContent = '✅ ' + file.name;
    }
  });
  dropzone.addEventListener('click', () => buktiInp.click());
});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\BioAquaLab\bioaqua\resources\views/pesanan/checkout.blade.php ENDPATH**/ ?>