<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>" class="<?php echo e(Cookie::get('tema') === 'dark' ? 'dark-mode' : ''); ?>">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

        
        <script>
        (function(){
          function getCookie(n){const m=document.cookie.match(new RegExp('(^| )'+n+'=([^;]+)'));return m?m[2]:'';}
          var tema = getCookie('tema') || localStorage.getItem('tema');
          if(tema==='dark') document.documentElement.classList.add('dark-mode');
          else if(tema==='light') document.documentElement.classList.remove('dark-mode');
        })();
        </script>

        <title>BioAqua Lab - <?php echo e(config('app.name', 'Laravel')); ?></title>

        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <!-- Custom CSS -->
        <link rel="stylesheet" href="<?php echo e(asset('css/style.css')); ?>">

        <style>
            body {
                background: linear-gradient(135deg, #0b1f3a 0%, #0d2a4d 50%, #0a2540 100%) !important;
                background-attachment: fixed !important;
                min-height: 100vh;
                font-family: 'Plus Jakarta Sans', 'Segoe UI', sans-serif;
            }
            .guest-wrapper {
                min-height: 100vh;
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: center;
                padding: 40px 16px;
            }
            .guest-logo {
                margin-bottom: 28px;
            }
            .guest-logo a {
                display: inline-flex;
                align-items: center;
                gap: 14px;
                text-decoration: none;
            }
            .guest-logo .logo-text-wrap {
                display: flex;
                flex-direction: column;
            }
            .guest-logo .logo-icon {
                width: 56px;
                height: 56px;
                border-radius: 14px;
                display: block;
                object-fit: cover;
            }
            .guest-logo .logo-text {
                font-size: 1.9rem;
                font-weight: 800;
                color: #fff;
                letter-spacing: -0.5px;
                line-height: 1.1;
            }
            .guest-logo .logo-text .accent {
                color: #38bdf8;
            }
            .guest-logo .logo-sub {
                display: block;
                font-size: 0.85rem;
                color: rgba(255,255,255,0.6);
                margin-bottom: 2px;
            }
            .guest-card {
                width: 100%;
                max-width: 460px;
                background: rgba(255,255,255,0.06);
                border: 1px solid rgba(255,255,255,0.12);
                backdrop-filter: blur(12px);
                border-radius: 22px;
                padding: 36px;
                box-shadow: 0 20px 60px rgba(0,0,0,0.35);
                color: #e2e8f0;
            }
            .guest-card .auth-label {
                color: #cbd5e1 !important;
            }
            .guest-card .auth-input {
                background: rgba(15,23,42,0.55) !important;
                border-color: rgba(255,255,255,0.15) !important;
                color: #f1f5f9 !important;
            }
            .guest-card .auth-input::placeholder { color: #94a3b8 !important; }
            .guest-card .auth-input:focus {
                border-color: #38bdf8 !important;
                box-shadow: 0 0 0 4px rgba(56,189,248,0.18) !important;
            }
            .guest-card .text-sm,
            .guest-card .text-gray-600 {
                color: #94a3b8 !important;
            }
            .guest-footer-text {
                margin-top: 24px;
                text-align: center;
                font-size: 0.8rem;
                color: rgba(255,255,255,0.5);
            }
        </style>
    </head>
    <body>
        <div class="guest-wrapper">
            <div class="guest-logo">
                <a href="<?php echo e(url('/')); ?>">
                    <img src="<?php echo e(asset('images/logo.png')); ?>" alt="BioAqua Lab" class="logo-icon">
                    <span class="logo-text-wrap">
                        <span class="logo-sub">Air Minum Berkualitas</span>
                        <span class="logo-text">BioAqua <span class="accent">Lab</span></span>
                    </span>
                </a>
            </div>

            <div class="guest-card">
                <?php echo e($slot); ?>

            </div>

            <p class="guest-footer-text">© <?php echo e(date('Y')); ?> BioAqua Lab. Semua hak dilindungi.</p>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>
       <?php /**PATH C:\xampp\htdocs\BioAquaLab\BioAquaLab\resources\views/layouts/guest.blade.php ENDPATH**/ ?>