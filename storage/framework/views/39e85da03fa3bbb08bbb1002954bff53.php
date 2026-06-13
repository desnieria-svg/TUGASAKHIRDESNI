<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BioAqua Lab — <?php echo $__env->yieldContent('title', 'Air Minum Bersih Jember'); ?></title>

    
    <script>
    (function(){
      function getCookie(n){const m=document.cookie.match(new RegExp('(^| )'+n+'=([^;]+)'));return m?m[2]:'';}
      if(getCookie('tema')==='dark') document.documentElement.classList.add('dark-mode');
    })();
    </script>

    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo e(asset('css/style.css')); ?>">
    <?php echo $__env->yieldPushContent('styles'); ?>
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <style>
      body {
        background: linear-gradient(180deg, #bfdbfe 0%, #dbeafe 25%, #eff6ff 55%, #f8fbff 80%, #ffffff 100%) !important;
        background-attachment: fixed !important;
        min-height: 100vh;
        font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
      }
      html.dark-mode body {
        background: linear-gradient(135deg, #0f1729 0%, #1a1a3e 50%, #0f2027 100%) !important;
      }
      main { min-height: calc(100vh - 70px - 280px); }

      /* Global card style upgrade */
      .card { border-radius: 16px !important; border: none !important; box-shadow: 0 4px 24px rgba(0,0,0,0.07) !important; }
      .tentang-card { background:#fff; border-radius:20px; padding:40px; box-shadow:0 8px 32px rgba(118,75,162,.1); border-top:4px solid #764ba2 !important; }
      .tentang-card h1 { color:#764ba2; font-weight:800; }
      .tentang-card h2 { color:#8b5cf6; font-weight:700; margin-top:24px; }
      .dashboard-wrapper { padding:32px 16px; }

      /* Better scrollbar */
      ::-webkit-scrollbar { width: 8px; height: 8px; }
      ::-webkit-scrollbar-track { background: #f1f5f9; }
      ::-webkit-scrollbar-thumb { background: #c4b5fd; border-radius: 4px; }
      ::-webkit-scrollbar-thumb:hover { background: #764ba2; }
    </style>
</head>
<body>
    <?php echo $__env->make('partials.navbar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <div class="container mt-3">
        <?php if(session('success')): ?>
        <div class="alert alert-success alert-dismissible fade show rounded-3 border-0 shadow-sm" role="alert" style="background:linear-gradient(135deg,#d1fae5,#a7f3d0);color:#065f46;">
            ✅ <?php echo e(session('success')); ?>

            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        <?php endif; ?>
        <?php if(session('error')): ?>
        <div class="alert alert-danger alert-dismissible fade show rounded-3 border-0 shadow-sm" role="alert">
            ❌ <?php echo e(session('error')); ?>

            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        <?php endif; ?>
        <?php if(session('warning')): ?>
        <div class="alert alert-warning alert-dismissible fade show rounded-3 border-0 shadow-sm" role="alert">
            ⚠️ <?php echo e(session('warning')); ?>

            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        <?php endif; ?>
    </div>

    <main><?php echo $__env->yieldContent('content'); ?></main>

    <?php echo $__env->make('components.footer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    
    <div class="gcm-overlay" id="gcmOverlay">
      <div class="gcm-box">
        <div class="gcm-icon" id="gcmIcon">⚠️</div>
        <h3 class="gcm-title" id="gcmTitle">Konfirmasi</h3>
        <p class="gcm-msg" id="gcmMsg">Apakah Anda yakin?</p>
        <div class="gcm-actions">
          <button type="button" class="gcm-btn gcm-cancel" id="gcmCancel">Batal</button>
          <button type="button" class="gcm-btn gcm-confirm" id="gcmConfirm">Ya, Lanjutkan</button>
        </div>
      </div>
    </div>
    <style>
    .gcm-overlay {
        position: fixed; inset: 0; z-index: 99999;
        background: rgba(15,23,42,0.45);
        backdrop-filter: blur(4px);
        display: none; align-items: center; justify-content: center;
        padding: 16px;
    }
    .gcm-overlay.show { display: flex; animation: gcmFadeIn .15s ease; }
    @keyframes gcmFadeIn { from { opacity:0; } to { opacity:1; } }
    .gcm-box {
        background: #fff; border-radius: 20px; padding: 32px 28px;
        max-width: 380px; width: 100%; text-align: center;
        box-shadow: 0 20px 60px rgba(0,0,0,0.25);
        animation: gcmPop .2s cubic-bezier(.34,1.56,.64,1);
    }
    @keyframes gcmPop { from { opacity:0; transform:scale(0.9) translateY(10px); } to { opacity:1; transform:scale(1) translateY(0); } }
    .gcm-icon { font-size: 2.8rem; margin-bottom: 12px; }
    .gcm-title { font-size: 1.15rem; font-weight: 800; color: #0f172a; margin: 0 0 8px; }
    .gcm-msg { font-size: 0.9rem; color: #64748b; margin: 0 0 24px; line-height: 1.6; }
    .gcm-actions { display: flex; gap: 10px; }
    .gcm-btn { flex: 1; padding: 11px; border-radius: 12px; border: none; font-size: 0.9rem; font-weight: 700; cursor: pointer; transition: .15s; }
    .gcm-cancel { background: #f1f5f9; color: #475569; }
    .gcm-cancel:hover { background: #e2e8f0; }
    .gcm-confirm { background: linear-gradient(135deg,#ef4444,#dc2626); color: #fff; }
    .gcm-confirm:hover { opacity:.9; transform:translateY(-1px); }
    .gcm-confirm.gcm-primary { background: linear-gradient(135deg,#0ea5e9,#0284c7); }
    .dark-mode .gcm-box { background:#16213e !important; }
    .dark-mode .gcm-title { color:#f1f5f9 !important; }
    .dark-mode .gcm-msg { color:#94a3b8 !important; }
    .dark-mode .gcm-cancel { background:#0f172a !important; color:#cbd5e1 !important; }
    </style>
    <script>
    function showConfirm(opts) {
        const overlay = document.getElementById('gcmOverlay');
        const icon    = document.getElementById('gcmIcon');
        const title   = document.getElementById('gcmTitle');
        const msg     = document.getElementById('gcmMsg');
        const btnOk   = document.getElementById('gcmConfirm');
        const btnNo   = document.getElementById('gcmCancel');

        icon.textContent  = opts.icon  || '⚠️';
        title.textContent = opts.title || 'Konfirmasi';
        msg.textContent   = opts.message || 'Apakah Anda yakin?';
        btnOk.textContent = opts.confirmText || 'Ya, Lanjutkan';
        btnNo.textContent = opts.cancelText  || 'Batal';
        btnOk.classList.toggle('gcm-primary', !!opts.primary);

        overlay.classList.add('show');

        function cleanup() {
            overlay.classList.remove('show');
            btnOk.removeEventListener('click', onOk);
            btnNo.removeEventListener('click', onNo);
            overlay.removeEventListener('click', onOverlay);
        }
        function onOk() { cleanup(); if (opts.onConfirm) opts.onConfirm(); }
        function onNo() { cleanup(); if (opts.onCancel) opts.onCancel(); }
        function onOverlay(e) { if (e.target === overlay) onNo(); }

        btnOk.addEventListener('click', onOk);
        btnNo.addEventListener('click', onNo);
        overlay.addEventListener('click', onOverlay);
    }

    // Intercept forms/links marked with data-confirm
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('[data-confirm]').forEach(function (el) {
            el.addEventListener('click', function (e) {
                e.preventDefault();
                const message = el.getAttribute('data-confirm') || 'Apakah Anda yakin?';
                const title   = el.getAttribute('data-confirm-title') || 'Konfirmasi';
                const icon    = el.getAttribute('data-confirm-icon') || '⚠️';
                const isPrimary = el.getAttribute('data-confirm-primary') === 'true';
                showConfirm({
                    title, message, icon, primary: isPrimary,
                    confirmText: el.getAttribute('data-confirm-ok') || 'Ya, Lanjutkan',
                    cancelText:  el.getAttribute('data-confirm-cancel') || 'Batal',
                    onConfirm: function () {
                        if (el.tagName === 'A') {
                            window.location.href = el.href;
                        } else if (el.tagName === 'BUTTON' || el.tagName === 'INPUT') {
                            const form = el.closest('form');
                            if (form) form.submit();
                        }
                    }
                });
            });
        });
    });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="<?php echo e(asset('js/script.js')); ?>"></script>
    <?php echo $__env->yieldPushContent('scripts'); ?>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\BioAquaLab\bioaqua\resources\views/layouts/app.blade.php ENDPATH**/ ?>