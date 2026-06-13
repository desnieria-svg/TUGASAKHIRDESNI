<?php $__env->startSection('title', 'Tambah Produk'); ?>

<?php $__env->startSection('content'); ?>
<div style="min-height:100vh; padding: 32px 16px;">
<div style="max-width:760px; margin:0 auto;">

    
    <div style="margin-bottom:24px; display:flex; align-items:center; justify-content:space-between; flex-wrap:wrap; gap:12px;">
        <div>
            <div style="display:inline-flex;align-items:center;gap:6px;background:linear-gradient(135deg,#dbeafe,#bfdbfe);color:#1d4ed8;padding:4px 12px;border-radius:99px;font-size:0.78rem;font-weight:600;margin-bottom:8px;">
                ⚙️ Admin Panel
            </div>
            <h1 style="font-size:1.6rem;font-weight:800;color:#0f172a;margin:0;">Tambah Produk Baru</h1>
            <p style="color:#64748b;font-size:0.9rem;margin:4px 0 0;">Isi semua field di bawah untuk menambahkan produk ke inventaris</p>
        </div>
        <a href="<?php echo e(route('barang.index')); ?>"
           style="display:inline-flex;align-items:center;gap:6px;background:#fff;border:1.5px solid #e2e8f0;color:#374151;padding:9px 18px;border-radius:10px;font-size:0.875rem;font-weight:600;text-decoration:none;transition:0.2s;box-shadow:0 2px 8px rgba(0,0,0,0.06);"
           onmouseover="this.style.borderColor='#0369a1';this.style.color='#0369a1'"
           onmouseout="this.style.borderColor='#e2e8f0';this.style.color='#374151'">
            ← Kembali ke Daftar
        </a>
    </div>

    
    <?php if($errors->any()): ?>
    <div style="background:#fef2f2;border:1px solid #fecaca;border-radius:12px;padding:14px 18px;margin-bottom:20px;color:#dc2626;font-size:0.875rem;">
        <strong>⚠️ Ada kesalahan input:</strong>
        <ul style="margin:6px 0 0 16px;padding:0;">
            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $err): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><li><?php echo e($err); ?></li><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    </div>
    <?php endif; ?>

    <form action="<?php echo e(route('barang.store')); ?>" method="POST" enctype="multipart/form-data" id="formTambahBarang">
        <?php echo csrf_field(); ?>

        
        <div style="background:#fff;border-radius:16px;padding:28px;box-shadow:0 4px 20px rgba(3,105,161,0.08);border:1px solid #bfdbfe;border-top:4px solid #0ea5e9;margin-bottom:16px;">
            <h3 style="font-size:0.95rem;font-weight:700;color:#0369a1;margin:0 0 20px;display:flex;align-items:center;gap:8px;">
                <span style="width:28px;height:28px;background:linear-gradient(135deg,#dbeafe,#bfdbfe);border-radius:8px;display:inline-flex;align-items:center;justify-content:center;font-size:0.85rem;">📦</span>
                Identitas Produk
            </h3>

            <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;">
                <div>
                    <label style="display:block;font-size:0.82rem;font-weight:600;color:#374151;margin-bottom:6px;">Kode Produk <span style="color:#ef4444">*</span></label>
                    <input type="text" name="kode" value="<?php echo e(old('kode')); ?>" placeholder="Contoh: BA-009"
                        style="width:100%;padding:10px 14px;border:1.5px solid <?php echo e($errors->has('kode') ? '#ef4444' : '#e2e8f0'); ?>;border-radius:10px;font-size:0.9rem;outline:none;box-sizing:border-box;transition:0.2s;"
                        onfocus="this.style.borderColor='#0369a1';this.style.boxShadow='0 0 0 3px rgba(3,105,161,0.12)'"
                        onblur="this.style.borderColor='#e2e8f0';this.style.boxShadow='none'">
                    <?php $__errorArgs = ['kode'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p style="color:#ef4444;font-size:0.78rem;margin:4px 0 0;"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
                <div>
                    <label style="display:block;font-size:0.82rem;font-weight:600;color:#374151;margin-bottom:6px;">Nama Produk <span style="color:#ef4444">*</span></label>
                    <input type="text" name="nama" value="<?php echo e(old('nama')); ?>" placeholder="Contoh: Air Mineral Galon"
                        style="width:100%;padding:10px 14px;border:1.5px solid <?php echo e($errors->has('nama') ? '#ef4444' : '#e2e8f0'); ?>;border-radius:10px;font-size:0.9rem;outline:none;box-sizing:border-box;transition:0.2s;"
                        onfocus="this.style.borderColor='#0369a1';this.style.boxShadow='0 0 0 3px rgba(3,105,161,0.12)'"
                        onblur="this.style.borderColor='#e2e8f0';this.style.boxShadow='none'">
                    <?php $__errorArgs = ['nama'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p style="color:#ef4444;font-size:0.78rem;margin:4px 0 0;"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
            </div>

            <div style="margin-top:16px;">
                <label style="display:block;font-size:0.82rem;font-weight:600;color:#374151;margin-bottom:6px;">Kategori <span style="color:#ef4444">*</span></label>
                <select name="kategori" class="inp-kategori"
                    style="width:100%;padding:10px 14px;border:1.5px solid <?php echo e($errors->has('kategori') ? '#ef4444' : '#e2e8f0'); ?>;border-radius:10px;font-size:0.9rem;outline:none;box-sizing:border-box;background:#f8fafc;cursor:pointer;transition:0.2s;"
                    onfocus="this.style.borderColor='#0369a1';this.style.boxShadow='0 0 0 3px rgba(3,105,161,0.12)'"
                    onblur="this.style.borderColor='#e2e8f0';this.style.boxShadow='none'">
                    <option value="" disabled <?php echo e(old('kategori') ? '' : 'selected'); ?>>-- Pilih Kategori --</option>
                    <?php $__currentLoopData = ['galon'=>'💧 Galon','botol'=>'🍶 Botol','cup'=>'🥤 Cup']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val=>$label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($val); ?>" <?php echo e(old('kategori')==$val?'selected':''); ?>><?php echo e($label); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                <?php $__errorArgs = ['kategori'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p style="color:#ef4444;font-size:0.78rem;margin:4px 0 0;"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
        </div>

        
        <div style="background:#fff;border-radius:16px;padding:28px;box-shadow:0 4px 20px rgba(3,105,161,0.08);border:1px solid #bbf7d0;border-top:4px solid #22c55e;margin-bottom:16px;">
            <h3 style="font-size:0.95rem;font-weight:700;color:#15803d;margin:0 0 20px;display:flex;align-items:center;gap:8px;">
                <span style="width:28px;height:28px;background:linear-gradient(135deg,#dcfce7,#bbf7d0);border-radius:8px;display:inline-flex;align-items:center;justify-content:center;font-size:0.85rem;">📊</span>
                Stok & Harga
            </h3>
            <div style="display:grid;grid-template-columns:1fr 1fr 1fr;gap:16px;">
                <div>
                    <label style="display:block;font-size:0.82rem;font-weight:600;color:#374151;margin-bottom:6px;">Jumlah Stok <span style="color:#ef4444">*</span></label>
                    <input type="number" name="jumlah" value="<?php echo e(old('jumlah',0)); ?>" min="0"
                        style="width:100%;padding:10px 14px;border:1.5px solid #e2e8f0;border-radius:10px;font-size:0.9rem;outline:none;box-sizing:border-box;"
                        onfocus="this.style.borderColor='#0369a1';this.style.boxShadow='0 0 0 3px rgba(3,105,161,0.12)'"
                        onblur="this.style.borderColor='#e2e8f0';this.style.boxShadow='none'">
                    <?php $__errorArgs = ['jumlah'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p style="color:#ef4444;font-size:0.78rem;margin:4px 0 0;"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
                <div>
                    <label style="display:block;font-size:0.82rem;font-weight:600;color:#374151;margin-bottom:6px;">Satuan <span style="color:#ef4444">*</span></label>
                    <input type="text" name="satuan" value="<?php echo e(old('satuan')); ?>" placeholder="pcs, liter, galon"
                        style="width:100%;padding:10px 14px;border:1.5px solid #e2e8f0;border-radius:10px;font-size:0.9rem;outline:none;box-sizing:border-box;"
                        onfocus="this.style.borderColor='#0369a1';this.style.boxShadow='0 0 0 3px rgba(3,105,161,0.12)'"
                        onblur="this.style.borderColor='#e2e8f0';this.style.boxShadow='none'">
                    <?php $__errorArgs = ['satuan'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p style="color:#ef4444;font-size:0.78rem;margin:4px 0 0;"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
                <div>
                    <label style="display:block;font-size:0.82rem;font-weight:600;color:#374151;margin-bottom:6px;">Harga (Rp) <span style="color:#ef4444">*</span></label>
                    <input type="number" name="harga" value="<?php echo e(old('harga')); ?>" min="0" placeholder="15000"
                        style="width:100%;padding:10px 14px;border:1.5px solid #e2e8f0;border-radius:10px;font-size:0.9rem;outline:none;box-sizing:border-box;"
                        onfocus="this.style.borderColor='#0369a1';this.style.boxShadow='0 0 0 3px rgba(3,105,161,0.12)'"
                        onblur="this.style.borderColor='#e2e8f0';this.style.boxShadow='none'">
                    <?php $__errorArgs = ['harga'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p style="color:#ef4444;font-size:0.78rem;margin:4px 0 0;"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
            </div>
        </div>

        
        <div style="background:#fff;border-radius:16px;padding:28px;box-shadow:0 4px 20px rgba(3,105,161,0.08);border:1px solid #fde68a;border-top:4px solid #f59e0b;margin-bottom:16px;">
            <h3 style="font-size:0.95rem;font-weight:700;color:#b45309;margin:0 0 20px;display:flex;align-items:center;gap:8px;">
                <span style="width:28px;height:28px;background:linear-gradient(135deg,#fef3c7,#fde68a);border-radius:8px;display:inline-flex;align-items:center;justify-content:center;font-size:0.85rem;">📋</span>
                Info Tambahan
            </h3>
            <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;">
                <div>
                    <label style="display:block;font-size:0.82rem;font-weight:600;color:#374151;margin-bottom:6px;">Supplier <span style="color:#ef4444">*</span></label>
                    <input type="text" name="supplier" value="<?php echo e(old('supplier')); ?>" placeholder="Nama supplier"
                        style="width:100%;padding:10px 14px;border:1.5px solid #e2e8f0;border-radius:10px;font-size:0.9rem;outline:none;box-sizing:border-box;"
                        onfocus="this.style.borderColor='#0369a1';this.style.boxShadow='0 0 0 3px rgba(3,105,161,0.12)'"
                        onblur="this.style.borderColor='#e2e8f0';this.style.boxShadow='none'">
                    <?php $__errorArgs = ['supplier'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p style="color:#ef4444;font-size:0.78rem;margin:4px 0 0;"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
                <div>
                    <label style="display:block;font-size:0.82rem;font-weight:600;color:#374151;margin-bottom:6px;">Tanggal Masuk <span style="color:#ef4444">*</span></label>
                    <input type="date" name="tanggal" value="<?php echo e(old('tanggal', date('Y-m-d'))); ?>"
                        style="width:100%;padding:10px 14px;border:1.5px solid #e2e8f0;border-radius:10px;font-size:0.9rem;outline:none;box-sizing:border-box;"
                        onfocus="this.style.borderColor='#0369a1';this.style.boxShadow='0 0 0 3px rgba(3,105,161,0.12)'"
                        onblur="this.style.borderColor='#e2e8f0';this.style.boxShadow='none'">
                    <?php $__errorArgs = ['tanggal'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p style="color:#ef4444;font-size:0.78rem;margin:4px 0 0;"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
            </div>

            
            <div style="margin-top:16px;">
                <label style="display:block;font-size:0.82rem;font-weight:600;color:#374151;margin-bottom:6px;">
                    Foto Produk <span style="color:#94a3b8;font-weight:400;">(opsional)</span>
                </label>

                
                <div id="dropzone"
                    style="display:flex;flex-direction:column;align-items:center;justify-content:center;gap:8px;border:2px dashed #f59e0b;border-radius:12px;padding:28px;cursor:pointer;transition:0.2s;background:#fffbeb;"
                    onclick="document.getElementById('foto-input').click()"
                    onmouseover="this.style.borderColor='#d97706';this.style.background='#fef3c7'"
                    onmouseout="this.style.borderColor='#f59e0b';this.style.background='#fffbeb'">
                    <span id="dropzone-icon" style="font-size:2.5rem;">📷</span>
                    <span id="dropzone-text" style="font-size:0.875rem;font-weight:600;color:#92400e;">Klik untuk memilih foto</span>
                    <span style="font-size:0.78rem;color:#b45309;">JPG, PNG — maks. 2MB</span>
                </div>

                
                <input type="file" id="foto-input" name="foto" accept="image/jpg,image/jpeg,image/png"
                    style="display:none;"
                    onchange="previewFoto(this)">

                
                <div id="foto-preview" style="margin-top:12px;display:none;text-align:center;">
                    <img id="foto-img" style="max-width:100%;max-height:200px;object-fit:contain;border-radius:12px;border:2px solid #fde68a;box-shadow:0 4px 12px rgba(0,0,0,0.08);">
                    <div style="margin-top:8px;">
                        <button type="button" onclick="hapusFoto()" style="font-size:0.78rem;color:#ef4444;background:none;border:1px solid #fecaca;border-radius:6px;padding:4px 10px;cursor:pointer;">
                            ✕ Hapus foto
                        </button>
                    </div>
                </div>

                <?php $__errorArgs = ['foto'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p style="color:#ef4444;font-size:0.78rem;margin:4px 0 0;"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
        </div>

        
        <div style="display:flex;gap:12px;justify-content:flex-end;padding-bottom:32px;">
            <a href="<?php echo e(route('barang.index')); ?>"
               style="padding:12px 24px;border:1.5px solid #e2e8f0;border-radius:10px;font-size:0.9rem;font-weight:600;color:#374151;text-decoration:none;background:#fff;box-shadow:0 2px 8px rgba(0,0,0,0.06);">
                Batal
            </a>
            <button type="submit"
                style="padding:12px 32px;background:linear-gradient(135deg,#0ea5e9,#0284c7);color:#fff;border:none;border-radius:10px;font-size:0.9rem;font-weight:700;cursor:pointer;transition:0.2s;display:flex;align-items:center;gap:8px;box-shadow:0 4px 16px rgba(2,132,199,0.35);"
                onmouseover="this.style.opacity='0.9'" onmouseout="this.style.opacity='1'">
                💾 Simpan Produk
            </button>
        </div>

    </form>
</div>
</div>

<script>
// Foto preview - FIXED
function previewFoto(input) {
    const file = input.files[0];
    if (!file) return;

    // Validasi ukuran (2MB)
    if (file.size > 2 * 1024 * 1024) {
        alert('Ukuran foto terlalu besar! Maksimal 2MB.');
        input.value = '';
        return;
    }

    const reader = new FileReader();
    reader.onload = function(e) {
        document.getElementById('foto-img').src = e.target.result;
        document.getElementById('foto-preview').style.display = 'block';
        document.getElementById('dropzone-icon').textContent = '✅';
        document.getElementById('dropzone-text').textContent = file.name;
    };
    reader.readAsDataURL(file);
}

function hapusFoto() {
    document.getElementById('foto-input').value = '';
    document.getElementById('foto-preview').style.display = 'none';
    document.getElementById('foto-img').src = '';
    document.getElementById('dropzone-icon').textContent = '📷';
    document.getElementById('dropzone-text').textContent = 'Klik untuk memilih foto';
}
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\BioAquaLab\BioAquaLab\resources\views/barang/create.blade.php ENDPATH**/ ?>