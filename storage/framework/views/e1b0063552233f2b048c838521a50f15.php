<?php $__env->startSection('title', 'Inventaris Produk'); ?>

<?php $__env->startSection('content'); ?>
<div style="min-height:100vh;background:transparent;padding:32px 16px;">
<div style="max-width:1200px;margin:0 auto;">

    
    <div style="display:flex;align-items:flex-start;justify-content:space-between;flex-wrap:wrap;gap:16px;margin-bottom:28px;">
        <div>
            <div style="display:inline-flex;align-items:center;gap:6px;background:#dbeafe;color:#1d4ed8;padding:4px 12px;border-radius:99px;font-size:0.78rem;font-weight:600;margin-bottom:8px;">
                ⚙️ Admin Panel
            </div>
            <h1 style="font-size:1.6rem;font-weight:800;color:#0f172a;margin:0;">Inventaris Produk</h1>
            <p style="color:#64748b;font-size:0.9rem;margin:4px 0 0;">Kelola semua stok produk air minum BioAqua Lab</p>
        </div>
        <a href="<?php echo e(route('barang.create')); ?>"
           style="display:inline-flex;align-items:center;gap:8px;background:linear-gradient(135deg,#0ea5e9,#0284c7);color:#fff;padding:11px 22px;border-radius:12px;font-size:0.9rem;font-weight:700;text-decoration:none;box-shadow:0 4px 14px rgba(2,132,199,0.35);transition:0.2s;"
           onmouseover="this.style.opacity='0.9';this.style.transform='translateY(-1px)'"
           onmouseout="this.style.opacity='1';this.style.transform='translateY(0)'">
            ➕ Tambah Produk
        </a>
    </div>

    
    <?php if(session('success')): ?>
    <div style="background:#f0fdf4;border:1px solid #bbf7d0;border-radius:12px;padding:12px 18px;margin-bottom:20px;color:#15803d;font-size:0.875rem;display:flex;align-items:center;gap:8px;">
        ✅ <?php echo e(session('success')); ?>

    </div>
    <?php endif; ?>
    <?php if(session('error')): ?>
    <div style="background:#fef2f2;border:1px solid #fecaca;border-radius:12px;padding:12px 18px;margin-bottom:20px;color:#dc2626;font-size:0.875rem;display:flex;align-items:center;gap:8px;">
        ❌ <?php echo e(session('error')); ?>

    </div>
    <?php endif; ?>

    
    <?php
        $total    = $barangs->total();
        $tersedia = $barangs->getCollection()->where('jumlah','>',0)->count();
        $habis    = $barangs->getCollection()->where('jumlah','<=',0)->count();
    ?>
    <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(150px,1fr));gap:12px;margin-bottom:24px;">
        <div style="background:#fff;border-radius:14px;padding:18px 20px;border:1px solid #e2e8f0;box-shadow:0 1px 4px rgba(0,0,0,0.05);">
            <div style="font-size:1.6rem;font-weight:800;color:#0284c7;"><?php echo e($total); ?></div>
            <div style="font-size:0.8rem;color:#64748b;margin-top:2px;">Total Produk</div>
        </div>
        <div style="background:#fff;border-radius:14px;padding:18px 20px;border:1px solid #e2e8f0;box-shadow:0 1px 4px rgba(0,0,0,0.05);">
            <div style="font-size:1.6rem;font-weight:800;color:#16a34a;"><?php echo e($tersedia); ?></div>
            <div style="font-size:0.8rem;color:#64748b;margin-top:2px;">Stok Tersedia</div>
        </div>
        <div style="background:#fff;border-radius:14px;padding:18px 20px;border:1px solid #e2e8f0;box-shadow:0 1px 4px rgba(0,0,0,0.05);">
            <div style="font-size:1.6rem;font-weight:800;color:#dc2626;"><?php echo e($habis); ?></div>
            <div style="font-size:0.8rem;color:#64748b;margin-top:2px;">Stok Habis</div>
        </div>
        <div style="background:#fff;border-radius:14px;padding:18px 20px;border:1px solid #e2e8f0;box-shadow:0 1px 4px rgba(0,0,0,0.05);">
            <div style="font-size:1.6rem;font-weight:800;color:#7c3aed;"><?php echo e($barangs->lastPage()); ?></div>
            <div style="font-size:0.8rem;color:#64748b;margin-top:2px;">Halaman</div>
        </div>
    </div>

    
    <div style="background:#fff;border-radius:16px;overflow:hidden;box-shadow:0 2px 12px rgba(0,0,0,0.06);border:1px solid #e2e8f0;">
        <div style="overflow-x:auto;">
        <table style="width:100%;border-collapse:collapse;">
            <thead>
                <tr style="background:linear-gradient(135deg,#0ea5e9,#0284c7);">
                    <th style="padding:14px 16px;font-size:0.78rem;font-weight:700;color:#fff;text-align:left;white-space:nowrap;">No</th>
                    <th style="padding:14px 16px;font-size:0.78rem;font-weight:700;color:#fff;text-align:left;white-space:nowrap;">Foto</th>
                    <th style="padding:14px 16px;font-size:0.78rem;font-weight:700;color:#fff;text-align:left;white-space:nowrap;">Kode</th>
                    <th style="padding:14px 16px;font-size:0.78rem;font-weight:700;color:#fff;text-align:left;">Nama Produk</th>
                    <th style="padding:14px 16px;font-size:0.78rem;font-weight:700;color:#fff;text-align:left;white-space:nowrap;">Kategori</th>
                    <th style="padding:14px 16px;font-size:0.78rem;font-weight:700;color:#fff;text-align:left;white-space:nowrap;">Stok</th>
                    <th style="padding:14px 16px;font-size:0.78rem;font-weight:700;color:#fff;text-align:left;white-space:nowrap;">Harga</th>
                    <th style="padding:14px 16px;font-size:0.78rem;font-weight:700;color:#fff;text-align:left;white-space:nowrap;">Supplier</th>
                    <th style="padding:14px 16px;font-size:0.78rem;font-weight:700;color:#fff;text-align:center;white-space:nowrap;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $katIcon=['galon'=>'💧','botol'=>'🍶','jerigen'=>'🪣','cup'=>'🥤']; ?>
                <?php $__empty_1 = true; $__currentLoopData = $barangs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $barang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr style="border-bottom:1px solid #f1f5f9;transition:background 0.15s;"
                    onmouseover="this.style.background='#f8fafc'" onmouseout="this.style.background='#fff'">
                    <td style="padding:14px 16px;font-size:0.85rem;color:#64748b;font-weight:600;">
                        <?php echo e($barangs->firstItem() + $index); ?>

                    </td>
                    <td style="padding:14px 16px;">
                        <?php if($barang->foto): ?>
                            <img src="<?php echo e(asset('storage/'.$barang->foto)); ?>"
                                 style="width:44px;height:44px;object-fit:cover;border-radius:10px;border:1px solid #e2e8f0;">
                        <?php else: ?>
                            <div style="width:44px;height:44px;background:#f1f5f9;border-radius:10px;display:flex;align-items:center;justify-content:center;font-size:1.4rem;">
                                <?php echo e($katIcon[$barang->kategori] ?? '📦'); ?>

                            </div>
                        <?php endif; ?>
                    </td>
                    <td style="padding:14px 16px;">
                        <span style="background:#dbeafe;color:#1d4ed8;padding:3px 10px;border-radius:6px;font-size:0.78rem;font-weight:700;font-family:monospace;">
                            <?php echo e($barang->kode); ?>

                        </span>
                    </td>
                    <td style="padding:14px 16px;">
                        <div style="font-size:0.875rem;font-weight:600;color:#1e293b;"><?php echo e($barang->nama); ?></div>
                    </td>
                    <td style="padding:14px 16px;">
                        <?php
                            $katColor=['galon'=>'#dbeafe:#1d4ed8','botol'=>'#dcfce7:#15803d','jerigen'=>'#fef3c7:#b45309','cup'=>'#fce7f3:#be185d'];
                            [$bg,$fg]=explode(':',$katColor[$barang->kategori]??'#f1f5f9:#374151');
                        ?>
                        <span style="background:<?php echo e($bg); ?>;color:<?php echo e($fg); ?>;padding:3px 10px;border-radius:99px;font-size:0.78rem;font-weight:600;">
                            <?php echo e($katIcon[$barang->kategori]??'📦'); ?> <?php echo e(ucfirst($barang->kategori)); ?>

                        </span>
                    </td>
                    <td style="padding:14px 16px;">
                        <span style="font-size:0.875rem;font-weight:700;color:<?php echo e($barang->jumlah > 0 ? '#16a34a' : '#dc2626'); ?>;">
                            <?php echo e($barang->jumlah); ?>

                        </span>
                        <span style="font-size:0.78rem;color:#94a3b8;"> <?php echo e($barang->satuan); ?></span>
                        <?php if($barang->jumlah <= 0): ?>
                            <span style="display:inline-block;background:#fee2e2;color:#dc2626;padding:1px 6px;border-radius:4px;font-size:0.7rem;font-weight:600;margin-left:4px;">HABIS</span>
                        <?php endif; ?>
                    </td>
                    <td style="padding:14px 16px;">
                        <span style="font-size:0.875rem;font-weight:700;color:#0369a1;">
                            Rp <?php echo e(number_format($barang->harga,0,',','.')); ?>

                        </span>
                    </td>
                    <td style="padding:14px 16px;font-size:0.85rem;color:#475569;"><?php echo e($barang->supplier); ?></td>
                    <td style="padding:14px 16px;text-align:center;">
                        <div style="display:flex;gap:6px;justify-content:center;flex-wrap:nowrap;">
                            <a href="<?php echo e(route('barang.edit', $barang)); ?>"
                               style="padding:6px 14px;background:#fef3c7;color:#b45309;border-radius:8px;font-size:0.78rem;font-weight:600;text-decoration:none;white-space:nowrap;transition:0.15s;"
                               onmouseover="this.style.background='#fde68a'" onmouseout="this.style.background='#fef3c7'">
                                ✏️ Edit
                            </a>
                            <form action="<?php echo e(route('barang.destroy', $barang)); ?>" method="POST" style="display:inline;">
                                <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                <button type="submit"
                                    data-confirm="Produk &quot;<?php echo e(addslashes($barang->nama)); ?>&quot; akan dihapus secara permanen dan tidak dapat dikembalikan."
                                    data-confirm-title="Hapus Produk?"
                                    data-confirm-icon="🗑️"
                                    data-confirm-ok="Ya, Hapus"
                                    style="padding:6px 14px;background:#fee2e2;color:#dc2626;border:none;border-radius:8px;font-size:0.78rem;font-weight:600;cursor:pointer;white-space:nowrap;transition:0.15s;"
                                    onmouseover="this.style.background='#fecaca'" onmouseout="this.style.background='#fee2e2'">
                                    🗑️ Hapus
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan="9" style="padding:48px;text-align:center;">
                        <div style="font-size:3rem;margin-bottom:12px;">📦</div>
                        <div style="font-weight:700;color:#1e293b;margin-bottom:4px;">Belum ada produk</div>
                        <div style="font-size:0.875rem;color:#94a3b8;margin-bottom:16px;">Tambahkan produk pertama kamu!</div>
                        <a href="<?php echo e(route('barang.create')); ?>"
                           style="display:inline-flex;align-items:center;gap:6px;background:linear-gradient(135deg,#0ea5e9,#0284c7);color:#fff;padding:10px 20px;border-radius:10px;font-size:0.875rem;font-weight:700;text-decoration:none;">
                            ➕ Tambah Sekarang
                        </a>
                    </td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
        </div>

        
        <?php if($barangs->hasPages()): ?>
        <div style="padding:16px 20px;border-top:1px solid #f1f5f9;display:flex;justify-content:center;">
            <?php echo e($barangs->links()); ?>

        </div>
        <?php endif; ?>
    </div>

</div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\BioAquaLab\bioaqua\resources\views/barang/index.blade.php ENDPATH**/ ?>