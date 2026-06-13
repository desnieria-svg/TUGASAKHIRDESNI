<!DOCTYPE html>
<html lang="id" class="<?php echo e(Cookie::get('tema') === 'dark' ? 'dark-mode' : ''); ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk — BioAqua Lab</title>
    <script>
        (function(){
            function getCookie(n){const m=document.cookie.match(new RegExp('(^| )'+n+'=([^;]+)'));return m?m[2]:'';}
            if(getCookie('tema')==='dark') document.documentElement.classList.add('dark-mode');
        })();
    </script>
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            font-family: 'Plus Jakarta Sans', 'Inter', sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(180deg, #bfdbfe 0%, #dbeafe 25%, #eff6ff 55%, #f8fbff 80%, #ffffff 100%);
            padding: 24px;
        }
        .login-card {
            background: #fff;
            border-radius: 20px;
            padding: 40px 36px;
            width: 100%;
            max-width: 420px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.1);
            text-align: center;
        }
        .login-logo {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 8px;
            text-decoration: none;
        }
        .login-logo-icon {
            width: 44px; height: 44px;
            background: linear-gradient(135deg, #0ea5e9, #0284c7);
            border-radius: 12px;
            display: flex; align-items: center; justify-content: center;
            font-size: 1.4rem;
        }
        .login-logo-text {
            font-size: 1.3rem;
            font-weight: 700;
            color: #0369a1;
        }
        .login-title {
            font-size: 1.4rem;
            font-weight: 700;
            color: #0f172a;
            margin: 20px 0 6px;
        }
        .login-sub {
            font-size: 0.9rem;
            color: #64748b;
            margin-bottom: 32px;
            line-height: 1.5;
        }
        .role-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 14px;
            margin-bottom: 24px;
        }
        .role-card {
            position: relative;
            border: 2px solid #e2e8f0;
            border-radius: 16px;
            padding: 24px 16px;
            cursor: pointer;
            transition: border-color 0.2s, box-shadow 0.2s, transform 0.15s;
            background: #f8fafc;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 10px;
        }
        .role-card:hover {
            border-color: #0ea5e9;
            box-shadow: 0 4px 20px rgba(14,165,233,0.15);
            transform: translateY(-2px);
        }
        .role-card.selected {
            border-color: #0284c7;
            background: #f0f9ff;
            box-shadow: 0 0 0 4px rgba(14,165,233,0.15);
        }
        .role-card input[type="radio"] {
            position: absolute;
            opacity: 0;
            width: 0; height: 0;
        }
        .role-icon {
            font-size: 2.8rem;
            line-height: 1;
        }
        .role-name {
            font-size: 1rem;
            font-weight: 700;
            color: #0f172a;
        }
        .role-desc {
            font-size: 0.75rem;
            color: #64748b;
            line-height: 1.4;
        }
        .role-check {
            position: absolute;
            top: 10px; right: 10px;
            width: 20px; height: 20px;
            border-radius: 50%;
            background: #0284c7;
            display: flex; align-items: center; justify-content: center;
            color: #fff;
            font-size: 0.7rem;
            opacity: 0;
            transition: opacity 0.15s;
        }
        .role-card.selected .role-check { opacity: 1; }

        .btn-masuk {
            width: 100%;
            background: linear-gradient(135deg, #0ea5e9, #0284c7);
            color: #fff;
            border: none;
            padding: 14px;
            border-radius: 12px;
            font-size: 1rem;
            font-weight: 700;
            cursor: pointer;
            transition: opacity 0.2s, transform 0.15s;
            margin-bottom: 16px;
        }
        .btn-masuk:hover { opacity: 0.9; transform: translateY(-1px); }
        .btn-masuk:active { transform: translateY(0); }
        .btn-masuk:disabled { opacity: 0.5; cursor: not-allowed; transform: none; }

        .login-back {
            font-size: 0.85rem;
            color: #64748b;
        }
        .login-back a {
            color: #0369a1;
            text-decoration: none;
            font-weight: 600;
        }
        .login-back a:hover { text-decoration: underline; }

        .alert-error {
            background: #fef2f2;
            border: 1px solid #fecaca;
            color: #dc2626;
            border-radius: 10px;
            padding: 10px 14px;
            font-size: 0.85rem;
            margin-bottom: 18px;
            text-align: left;
        }

        /* Dark mode */
        .dark-mode body { background: linear-gradient(135deg, #0f172a, #1e293b, #0f172a) !important; }
        .dark-mode .login-card { background: #1e293b !important; box-shadow: 0 20px 60px rgba(0,0,0,0.4) !important; }
        .dark-mode .login-title { color: #f1f5f9 !important; }
        .dark-mode .login-sub { color: #94a3b8 !important; }
        .dark-mode .role-card { background: #0f172a !important; border-color: #334155 !important; }
        .dark-mode .role-card:hover { border-color: #0ea5e9 !important; }
        .dark-mode .role-card.selected { background: #0f3460 !important; border-color: #38bdf8 !important; }
        .dark-mode .role-name { color: #f1f5f9 !important; }
        .dark-mode .role-desc { color: #94a3b8 !important; }
        .dark-mode .login-back { color: #94a3b8 !important; }
        .dark-mode .login-back a { color: #38bdf8 !important; }
    </style>
</head>
<body>

<div class="login-card">

    <a href="<?php echo e(url('/')); ?>" class="login-logo">
        <div class="login-logo-icon">💧</div>
        <span class="login-logo-text">BioAqua Lab</span>
    </a>

    <h1 class="login-title">Masuk sebagai siapa?</h1>
    <p class="login-sub">Pilih peran Anda untuk melanjutkan ke halaman yang sesuai.</p>

    <?php if($errors->any()): ?>
        <div class="alert-error"><?php echo e($errors->first()); ?></div>
    <?php endif; ?>

    <form action="<?php echo e(route('quick.login')); ?>" method="POST" id="loginForm">
        <?php echo csrf_field(); ?>

        <div class="role-grid">
            <!-- Admin -->
            <label class="role-card" id="card-admin" onclick="selectRole('admin')">
                <input type="radio" name="role" value="admin" id="role-admin" />
                <div class="role-check">✓</div>
                <div class="role-icon">⚙️</div>
                <div class="role-name">Admin</div>
                <div class="role-desc">Kelola inventaris & pesanan</div>
            </label>

            <!-- User -->
            <label class="role-card" id="card-user" onclick="selectRole('user')">
                <input type="radio" name="role" value="user" id="role-user" />
                <div class="role-check">✓</div>
                <div class="role-icon">👤</div>
                <div class="role-name">Pelanggan</div>
                <div class="role-desc">Pesan produk air minum</div>
            </label>
        </div>

        <button type="submit" class="btn-masuk" id="btnMasuk" disabled>
            Masuk →
        </button>
    </form>

    <p class="login-back">
        <a href="<?php echo e(url('/')); ?>">← Kembali ke beranda</a>
    </p>

</div>

<script>
function selectRole(role) {
    document.getElementById('role-' + role).checked = true;
    document.querySelectorAll('.role-card').forEach(c => c.classList.remove('selected'));
    document.getElementById('card-' + role).classList.add('selected');
    document.getElementById('btnMasuk').disabled = false;
}
// Jaga-jaga kalau user klik langsung di input radio
document.querySelectorAll('input[name="role"]').forEach(r => {
    r.addEventListener('change', () => selectRole(r.value));
});
</script>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\BioAquaLab\bioaqua\resources\views/auth/quick-login.blade.php ENDPATH**/ ?>