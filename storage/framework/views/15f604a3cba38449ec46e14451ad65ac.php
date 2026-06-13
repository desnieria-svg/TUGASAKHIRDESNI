<nav class="site-nav" id="siteNavbar">
    <div class="site-nav-inner">

        <!-- Logo kiri mentok -->
        <a href="<?php echo e(url('/')); ?>" class="site-brand">
            <div class="site-brand-icon">💧</div>
            <span class="site-brand-text">BioAqua Lab</span>
        </a>

        <!-- Menu kanan -->
        <div class="site-nav-right">

            <!-- Nav links -->
            <ul class="site-nav-menu">
                <li><a href="<?php echo e(url('/')); ?>"        class="nav-link <?php echo e(request()->is('/') ? 'active' : ''); ?>">Beranda</a></li>
                <li><a href="<?php echo e(url('/#produk')); ?>" class="nav-link <?php echo e(request()->is('produk') ? 'active' : ''); ?>">Produk</a></li>
                <li><a href="<?php echo e(url('/tentang')); ?>"  class="nav-link <?php echo e(request()->is('tentang') ? 'active' : ''); ?>">Tentang</a></li>
                <li><a href="<?php echo e(url('/kontak')); ?>"   class="nav-link <?php echo e(request()->is('kontak') ? 'active' : ''); ?>">Kontak</a></li>
            </ul>

            <!-- Search box — style browser -->
            <div class="nav-search-wrap">
                <div class="nav-search-box" id="searchBox">
                    <svg class="search-svg-icon" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="8.5" cy="8.5" r="5.5" stroke="currentColor" stroke-width="1.6"/>
                        <path d="M13.5 13.5L17 17" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/>
                    </svg>
                    <input type="text" id="navSearchInput" class="nav-search-input" placeholder="Cari di web" autocomplete="off" />
                    <button class="search-clear" id="searchClear" type="button" title="Hapus">
                        <svg viewBox="0 0 20 20" fill="none" width="14" height="14"><circle cx="10" cy="10" r="8" stroke="currentColor" stroke-width="1.5"/><path d="M7 7l6 6M13 7l-6 6" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/></svg>
                    </button>
                </div>
                <div class="nav-search-results" id="navSearchResults"></div>
            </div>

            <!-- Keranjang (user login non-admin) -->
            <?php if(auth()->guard()->check()): ?>
                <?php if(auth()->user()->role !== 'admin'): ?>
                <button class="icon-btn cart-btn" id="cartToggle" title="Keranjang" aria-label="Keranjang belanja">
                    🛒
                    <span class="cart-badge" id="cartBadge" style="display:none;">0</span>
                </button>
                <?php endif; ?>
            <?php endif; ?>

            <!-- Dark mode toggle -->
            <button class="icon-btn theme-btn" id="btn-darkmode" onclick="toggleDarkMode()" title="Ganti tema">
                <span id="themeIcon">🌙</span>
            </button>

            <!-- User / Login -->
            <?php if(auth()->guard()->check()): ?>
                <div class="user-menu-wrap">
                    <button class="user-avatar-btn" id="userMenuToggle" aria-label="Menu pengguna">
                        <svg viewBox="0 0 24 24" fill="currentColor" width="22" height="22"><circle cx="12" cy="8" r="4"/><path d="M4 20c0-4 3.6-7 8-7s8 3 8 7" fill-rule="evenodd"/></svg>
                    </button>
                    <div class="user-dropdown" id="userDropdown">
                        <div class="dropdown-header">
                            <strong><?php echo e(auth()->user()->name); ?></strong>
                            <small class="role-pill">
                                <?php if(auth()->user()->role === 'admin'): ?>
                                    <svg viewBox="0 0 24 24" fill="none" width="13" height="13" xmlns="http://www.w3.org/2000/svg"><path d="M12 2l1.6 3.2 3.5.5-2.5 2.5.6 3.5-3.2-1.7-3.2 1.7.6-3.5L7 5.7l3.5-.5L12 2Z" fill="currentColor"/><path d="M5 14l1 4 6-2 6 2 1-4" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/></svg> Admin
                                <?php else: ?>
                                    <svg viewBox="0 0 24 24" fill="currentColor" width="13" height="13"><circle cx="12" cy="8" r="4"/><path d="M4 20c0-4 3.6-7 8-7s8 3 8 7" fill-rule="evenodd"/></svg> Pelanggan
                                <?php endif; ?>
                            </small>
                        </div>
                        <a href="<?php echo e(url('/dashboard')); ?>" class="dropdown-item">
                            <svg viewBox="0 0 24 24" fill="none" width="16" height="16" xmlns="http://www.w3.org/2000/svg"><rect x="3" y="3" width="7" height="9" rx="1.5" stroke="currentColor" stroke-width="1.7"/><rect x="14" y="3" width="7" height="5" rx="1.5" stroke="currentColor" stroke-width="1.7"/><rect x="14" y="12" width="7" height="9" rx="1.5" stroke="currentColor" stroke-width="1.7"/><rect x="3" y="16" width="7" height="5" rx="1.5" stroke="currentColor" stroke-width="1.7"/></svg>
                            Dashboard
                        </a>
                        <?php if(auth()->user()->role === 'admin'): ?>
                            <a href="<?php echo e(route('barang.index')); ?>" class="dropdown-item">
                                <svg viewBox="0 0 24 24" fill="none" width="16" height="16" xmlns="http://www.w3.org/2000/svg"><path d="M21 8l-9-5-9 5 9 5 9-5Z" stroke="currentColor" stroke-width="1.7" stroke-linejoin="round"/><path d="M3 8v8l9 5 9-5V8" stroke="currentColor" stroke-width="1.7" stroke-linejoin="round"/><path d="M12 13v8" stroke="currentColor" stroke-width="1.7"/></svg>
                                Inventaris
                            </a>
                            <a href="<?php echo e(route('barang.create')); ?>" class="dropdown-item">
                                <svg viewBox="0 0 24 24" fill="none" width="16" height="16" xmlns="http://www.w3.org/2000/svg"><path d="M12 5v14M5 12h14" stroke="currentColor" stroke-width="1.9" stroke-linecap="round"/></svg>
                                Tambah Barang
                            </a>
                            <a href="<?php echo e(route('admin.pesanan')); ?>" class="dropdown-item">
                                <svg viewBox="0 0 24 24" fill="none" width="16" height="16" xmlns="http://www.w3.org/2000/svg"><rect x="4" y="3" width="16" height="18" rx="2" stroke="currentColor" stroke-width="1.7"/><path d="M8 8h8M8 12h8M8 16h5" stroke="currentColor" stroke-width="1.7" stroke-linecap="round"/></svg>
                                Kelola Pesanan
                            </a>
                        <?php else: ?>
                            <a href="#" class="dropdown-item" onclick="document.getElementById('cartToggle')?.click();return false;">
                                <svg viewBox="0 0 24 24" fill="none" width="16" height="16" xmlns="http://www.w3.org/2000/svg"><circle cx="9" cy="21" r="1.4" fill="currentColor"/><circle cx="18" cy="21" r="1.4" fill="currentColor"/><path d="M2 3h2l2.4 12.4a2 2 0 0 0 2 1.6h8.6a2 2 0 0 0 2-1.6L21 7H6" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                Keranjang
                            </a>
                            <a href="/riwayat" class="dropdown-item">
                                <svg viewBox="0 0 24 24" fill="none" width="16" height="16" xmlns="http://www.w3.org/2000/svg"><rect x="4" y="3" width="16" height="18" rx="2" stroke="currentColor" stroke-width="1.7"/><path d="M8 8h8M8 12h8M8 16h5" stroke="currentColor" stroke-width="1.7" stroke-linecap="round"/></svg>
                                Riwayat Pesanan
                            </a>
                        <?php endif; ?>
                        <div class="dropdown-divider"></div>
                        <button class="dropdown-item dropdown-logout" onclick="doLogout()">
                            <svg viewBox="0 0 24 24" fill="none" width="16" height="16" xmlns="http://www.w3.org/2000/svg"><path d="M16 17l5-5-5-5M21 12H9M13 21H6a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h7" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"/></svg>
                            Logout
                        </button>
                        <form id="logoutForm" action="<?php echo e(route('logout')); ?>" method="POST" style="display:none;"><?php echo csrf_field(); ?></form>
                    </div>
                </div>
            <?php else: ?>
                <a href="<?php echo e(route('login')); ?>" class="user-avatar-btn" title="Login" aria-label="Login">
                    <svg viewBox="0 0 24 24" fill="currentColor" width="22" height="22"><circle cx="12" cy="8" r="4"/><path d="M4 20c0-4 3.6-7 8-7s8 3 8 7" fill-rule="evenodd"/></svg>
                </a>
            <?php endif; ?>

        </div><!-- /navbar-right -->
    </div>
</nav>

<!-- KERANJANG PANEL -->
<?php if(auth()->guard()->check()): ?>
<?php if(auth()->user()->role !== 'admin'): ?>
<div class="cart-overlay" id="cartOverlay"></div>
<aside class="cart-panel" id="cartPanel">
    <div class="cart-panel-header">
        <h3>🛒 Keranjang Belanja</h3>
        <button class="cart-close" id="cartClose">✕</button>
    </div>
    <div class="cart-panel-body">
        <div class="cart-empty" id="cartEmpty">
            <span>🛒</span>
            <p>Keranjang masih kosong</p>
            <small>Pilih produk dan klik + Pesan</small>
        </div>
        <ul class="cart-list" id="cartList"></ul>
    </div>
    <div class="cart-panel-footer" id="cartFooter" style="display:none;">
        <div class="cart-total">
            <span>Total:</span>
            <strong id="cartTotal">Rp 0</strong>
        </div>
        <button class="btn-checkout" onclick="checkout()">✅ Buat Pesanan</button>
    </div>
</aside>
<?php endif; ?>
<?php endif; ?>

<style>
/* ===========================
   NAVBAR
   =========================== */
.site-nav {
    background: #ffffff;
    height: 60px;
    border-bottom: 1px solid #e5e7eb;
    position: sticky;
    top: 0;
    z-index: 1000;
}
.site-nav-inner {
    width: 100%;
    padding: 0 24px;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 16px;
    box-sizing: border-box;
}

/* Logo — kiri mentok */
.site-brand {
    display: flex;
    align-items: center;
    gap: 9px;
    text-decoration: none;
    flex-shrink: 0;
}
.site-brand-icon {
    width: 34px;
    height: 34px;
    background: linear-gradient(135deg, #0ea5e9, #0284c7);
    border-radius: 9px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1rem;
}
.site-brand-text {
    font-weight: 700;
    font-size: 1.05rem;
    color: #0369a1;
    white-space: nowrap;
}

/* Kanan: semua menu + actions */
.site-nav-right {
    display: flex;
    align-items: center;
    gap: 4px;
    margin-left: auto;
}

/* Nav links */
.site-nav-menu {
    list-style: none;
    display: flex;
    align-items: center;
    gap: 2px;
    margin: 0;
    padding: 0;
}
.nav-link {
    display: block;
    padding: 6px 14px;
    border-radius: 99px;
    font-size: 0.9rem;
    font-weight: 500;
    color: #374151;
    text-decoration: none;
    transition: background 0.15s, color 0.15s;
    white-space: nowrap;
}
.nav-link:hover { background: #f0f9ff; color: #0369a1; }
.nav-link.active { background: #e0f2fe; color: #0369a1; font-weight: 600; }

/* ===========================
   SEARCH BOX — style browser
   =========================== */
.nav-search-wrap {
    position: relative;
    margin: 0 6px;
}
.nav-search-box {
    display: flex;
    align-items: center;
    gap: 8px;
    height: 36px;
    background: #f3f4f6;
    border: 1.5px solid transparent;
    border-radius: 99px;
    padding: 0 12px;
    width: 200px;
    transition: width 0.25s ease, border-color 0.15s, background 0.15s, box-shadow 0.15s;
    cursor: text;
}
.nav-search-box:focus-within {
    width: 300px;
    background: #fff;
    border-color: #93c5fd;
    box-shadow: 0 0 0 3px rgba(147,197,253,0.25);
}
.search-svg-icon {
    width: 16px;
    height: 16px;
    color: #9ca3af;
    flex-shrink: 0;
    transition: color 0.15s;
}
.nav-search-box:focus-within .search-svg-icon { color: #0369a1; }
.nav-search-input {
    flex: 1;
    border: none;
    background: transparent;
    outline: none;
    font-size: 0.875rem;
    color: #111827;
    min-width: 0;
}
.nav-search-input::placeholder { color: #9ca3af; }
.search-clear {
    background: none;
    border: none;
    cursor: pointer;
    color: #9ca3af;
    display: none;
    padding: 0;
    line-height: 1;
    align-items: center;
    justify-content: center;
}
.search-clear:hover { color: #374151; }
.nav-search-input:not(:placeholder-shown) ~ .search-clear { display: flex; }
.nav-search-results {
    position: absolute;
    top: calc(100% + 6px);
    left: 0;
    width: 300px;
    background: #fff;
    border-radius: 14px;
    box-shadow: 0 8px 28px rgba(0,0,0,0.13);
    border: 1px solid #e5e7eb;
    z-index: 2000;
    display: none;
    overflow: hidden;
}
.nav-search-results.show { display: block; }
.search-result-item {
    padding: 10px 16px;
    display: flex;
    align-items: center;
    gap: 10px;
    font-size: 0.875rem;
    color: #111827;
    text-decoration: none;
    border-bottom: 1px solid #f3f4f6;
    transition: background 0.1s;
    cursor: pointer;
}
.search-result-item:last-child { border-bottom: none; }
.search-result-item:hover { background: #f0f9ff; }
.search-no-result { padding: 14px 16px; color: #9ca3af; font-size: 0.85rem; text-align: center; }

/* ===========================
   ICON BUTTONS
   =========================== */
.icon-btn, .theme-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 36px;
    height: 36px;
    border-radius: 99px;
    background: transparent;
    border: none;
    cursor: pointer;
    font-size: 1.1rem;
    color: #374151;
    transition: background 0.15s;
    position: relative;
    text-decoration: none;
    flex-shrink: 0;
}
.icon-btn:hover, .theme-btn:hover { background: #f3f4f6; }

/* User avatar button */
.user-avatar-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 34px;
    height: 34px;
    border-radius: 50%;
    background: #e0f2fe;
    border: none;
    cursor: pointer;
    color: #0369a1;
    transition: background 0.15s;
    text-decoration: none;
    flex-shrink: 0;
}
.user-avatar-btn:hover { background: #bae6fd; }

/* Cart badge */
.cart-badge {
    position: absolute;
    top: 0; right: 0;
    background: #ef4444;
    color: #fff;
    font-size: 0.6rem;
    font-weight: 700;
    min-width: 16px;
    height: 16px;
    border-radius: 9px;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 0 3px;
}

/* User dropdown */
.user-menu-wrap { position: relative; }
.user-dropdown {
    position: absolute;
    top: calc(100% + 8px);
    right: 0;
    width: 200px;
    background: #fff;
    border-radius: 14px;
    box-shadow: 0 8px 28px rgba(0,0,0,0.13);
    border: 1px solid #e5e7eb;
    z-index: 2000;
    display: none;
    overflow: hidden;
}
.user-dropdown.open { display: block; }
.dropdown-header {
    padding: 12px 16px;
    background: #f0f9ff;
    display: flex;
    flex-direction: column;
    gap: 2px;
    border-bottom: 1px solid #e5e7eb;
}
.dropdown-header strong { font-size: 0.9rem; color: #0f172a; }
.dropdown-header small { font-size: 0.75rem; color: #6b7280; }
.role-pill { display:inline-flex; align-items:center; gap:5px; }
.dropdown-item {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 9px 16px;
    font-size: 0.875rem;
    color: #374151;
    text-decoration: none;
    transition: background 0.1s;
    background: none;
    border: none;
    width: 100%;
    text-align: left;
    cursor: pointer;
}
.dropdown-item svg { flex-shrink:0; opacity:0.75; }
.dropdown-item:hover { background: #f0f9ff; color: #0369a1; }
.dropdown-divider { height: 1px; background: #f3f4f6; margin: 4px 0; }
.dropdown-logout { color: #ef4444; }
.dropdown-logout:hover { background: #fef2f2 !important; color: #dc2626 !important; }

/* ===========================
   KERANJANG PANEL
   =========================== */
.cart-overlay {
    position: fixed; inset: 0;
    background: rgba(0,0,0,0.3);
    z-index: 1099;
    display: none;
}
.cart-overlay.show { display: block; }
.cart-panel {
    position: fixed;
    top: 0; right: 0;
    width: 320px;
    height: 100vh;
    background: #fff;
    z-index: 1100;
    transform: translateX(100%);
    transition: transform 0.28s cubic-bezier(.4,0,.2,1);
    display: flex;
    flex-direction: column;
    box-shadow: -4px 0 24px rgba(0,0,0,0.1);
}
.cart-panel.open { transform: translateX(0); }
.cart-panel-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 16px 18px;
    border-bottom: 1px solid #e5e7eb;
}
.cart-panel-header h3 { font-size: 0.95rem; font-weight: 700; color: #0f172a; margin: 0; }
.cart-close { background: none; border: none; font-size: 1rem; cursor: pointer; color: #6b7280; padding: 4px 8px; border-radius: 6px; }
.cart-close:hover { background: #fee2e2; color: #ef4444; }
.cart-panel-body { flex: 1; overflow-y: auto; padding: 14px; }
.cart-empty { display: flex; flex-direction: column; align-items: center; justify-content: center; height: 180px; color: #9ca3af; gap: 6px; text-align: center; }
.cart-empty span { font-size: 2.5rem; }
.cart-empty p { font-weight: 600; font-size: 0.9rem; color: #6b7280; margin: 0; }
.cart-list { list-style: none; padding: 0; margin: 0; display: flex; flex-direction: column; gap: 8px; }
.cart-item { display: flex; align-items: center; gap: 10px; padding: 10px 12px; background: #f8fafc; border-radius: 10px; border: 1px solid #e5e7eb; }
.cart-item-icon { font-size: 1.6rem; width: 32px; text-align: center; }
.cart-item-info { flex: 1; min-width: 0; }
.cart-item-name { font-size: 0.82rem; font-weight: 600; color: #1e293b; margin: 0 0 2px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
.cart-item-price { font-size: 0.75rem; color: #0369a1; font-weight: 600; }
.cart-item-qty { display: flex; align-items: center; gap: 5px; }
.qty-btn { width: 24px; height: 24px; border-radius: 50%; background: #e0f2fe; border: none; font-size: 0.9rem; font-weight: 700; color: #0369a1; cursor: pointer; display: flex; align-items: center; justify-content: center; padding: 0; }
.qty-btn:hover { background: #0369a1; color: #fff; }
.qty-num { font-size: 0.85rem; font-weight: 700; color: #1e293b; min-width: 18px; text-align: center; }
.cart-panel-footer { padding: 14px 18px; border-top: 1px solid #e5e7eb; }
.cart-total { display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px; font-size: 0.9rem; color: #374151; }
.cart-total strong { font-size: 1.05rem; color: #0369a1; }
.btn-checkout { width: 100%; background: linear-gradient(135deg, #0ea5e9, #0284c7); color: #fff; border: none; padding: 11px; border-radius: 10px; font-size: 0.9rem; font-weight: 700; cursor: pointer; transition: opacity 0.2s; }
.btn-checkout:hover { opacity: 0.9; }

/* ===========================
   DARK MODE
   =========================== */
.dark-mode .site-nav { background: #0f172a !important; border-color: #1e293b !important; }
.dark-mode .site-brand-text { color: #38bdf8 !important; }
.dark-mode .site-nav-menu .nav-link { color: #cbd5e1 !important; }
.dark-mode .site-nav-menu .nav-link:hover, .dark-mode .site-nav-menu .nav-link.active { background: #1e3a5f !important; color: #38bdf8 !important; }
.dark-mode .nav-search-box { background: #1e293b !important; border-color: transparent; }
.dark-mode .nav-search-box:focus-within { background: #0f172a !important; border-color: #38bdf8 !important; box-shadow: 0 0 0 3px rgba(56,189,248,0.2) !important; }
.dark-mode .nav-search-input { color: #f1f5f9 !important; }
.dark-mode .nav-search-input::placeholder { color: #64748b !important; }
.dark-mode .search-svg-icon { color: #64748b !important; }
.dark-mode .nav-search-box:focus-within .search-svg-icon { color: #38bdf8 !important; }
.dark-mode .nav-search-results { background: #1e293b !important; border-color: #334155 !important; }
.dark-mode .search-result-item { color: #e2e8f0 !important; border-color: #334155 !important; }
.dark-mode .search-result-item:hover { background: #1e3a5f !important; }
.dark-mode .icon-btn, .dark-mode .theme-btn { color: #cbd5e1 !important; }
.dark-mode .icon-btn:hover, .dark-mode .theme-btn:hover { background: #1e293b !important; }
.dark-mode .user-avatar-btn { background: #1e3a5f !important; color: #38bdf8 !important; }
.dark-mode .user-avatar-btn:hover { background: #1e4976 !important; }
.dark-mode .user-dropdown { background: #1e293b !important; border-color: #334155 !important; }
.dark-mode .dropdown-header { background: #0f3460 !important; border-color: #334155 !important; }
.dark-mode .dropdown-header strong { color: #f1f5f9 !important; }
.dark-mode .dropdown-header small { color: #94a3b8 !important; }
.dark-mode .dropdown-item { color: #cbd5e1 !important; }
.dark-mode .dropdown-item:hover { background: #1e3a5f !important; color: #38bdf8 !important; }
.dark-mode .cart-panel { background: #1e293b !important; }
.dark-mode .cart-panel-header { border-color: #334155 !important; }
.dark-mode .cart-panel-header h3 { color: #f1f5f9 !important; }
.dark-mode .cart-panel-body { background: #1e293b !important; }
.dark-mode .cart-panel-footer { border-color: #334155 !important; }
.dark-mode .cart-item { background: #0f172a !important; border-color: #334155 !important; }
.dark-mode .cart-item-name { color: #f1f5f9 !important; }
.dark-mode .cart-total { color: #cbd5e1 !important; }
.dark-mode .cart-total strong { color: #38bdf8 !important; }
.dark-mode .search-clear { color: #64748b !important; }
.dark-mode .search-clear:hover { color: #cbd5e1 !important; }
</style>

<script>
/* ── Dark mode ── */
function setCookie(n,v,d){const e=new Date();e.setTime(e.getTime()+(d*864e5));document.cookie=n+'='+v+';expires='+e.toUTCString()+';path=/';}
function getCookie(n){const m=document.cookie.match(new RegExp('(^| )'+n+'=([^;]+)'));return m?m[2]:'';}
function toggleDarkMode(){
    document.documentElement.classList.toggle('dark-mode');
    const dark=document.documentElement.classList.contains('dark-mode');
    setCookie('tema',dark?'dark':'light',30);
    document.getElementById('themeIcon').textContent=dark?'☀️':'🌙';
}

/* ── Keranjang global (inisiasi sebelum DOMContentLoaded agar tambahKeranjang bisa dipanggil kapanpun) ── */
window._cart = {};

window.tambahKeranjang = function(btn, nama, harga, icon, id, kategori, foto) {
    if (!window._cart[nama]) window._cart[nama] = {id: id||0, nama, harga: harga||0, icon: icon||'💧', kategori: kategori||'', foto: foto||'', qty: 0};
    window._cart[nama].qty++;
    renderCart();
    btn.textContent = '✓ Ditambah!';
    btn.style.background = '#16a34a';
    setTimeout(() => { btn.textContent = '+ Pesan'; btn.style.background = ''; }, 1200);
};

window._changeQty = function(nama, delta) {
    if (!window._cart[nama]) return;
    window._cart[nama].qty = Math.max(0, window._cart[nama].qty + delta);
    renderCart();
};

function renderCart() {
    const list   = document.getElementById('cartList');
    const empty  = document.getElementById('cartEmpty');
    const footer = document.getElementById('cartFooter');
    const badge  = document.getElementById('cartBadge');
    if (!list) return; // panel tidak ada (admin / belum login)

    const items = Object.values(window._cart).filter(i => i.qty > 0);
    const total = items.reduce((s, i) => s + (i.harga * i.qty), 0);
    const count = items.reduce((s, i) => s + i.qty, 0);

    if (badge) { badge.textContent = count; badge.style.display = count > 0 ? 'flex' : 'none'; }

    if (!items.length) {
        list.innerHTML = '';
        if (empty)  empty.style.display  = 'flex';
        if (footer) footer.style.display = 'none';
        return;
    }
    if (empty)  empty.style.display  = 'none';
    if (footer) footer.style.display = 'block';
    document.getElementById('cartTotal').textContent = 'Rp ' + total.toLocaleString('id-ID');

    list.innerHTML = items.map(i => `
        <li class="cart-item">
            <span class="cart-item-icon">${i.icon}</span>
            <div class="cart-item-info">
                <p class="cart-item-name">${i.nama}</p>
                <span class="cart-item-price">Rp ${(i.harga * i.qty).toLocaleString('id-ID')}</span>
            </div>
            <div class="cart-item-qty">
                <button class="qty-btn" onclick="window._changeQty('${i.nama}', -1)">−</button>
                <span class="qty-num">${i.qty}</span>
                <button class="qty-btn" onclick="window._changeQty('${i.nama}', 1)">+</button>
            </div>
        </li>`).join('');
}

window.doLogout = function() { document.getElementById('logoutForm').submit(); };
window.checkout = function() {
    const items = Object.values(window._cart).filter(i => i.qty > 0);
    if (!items.length) return;
    localStorage.setItem('bioaqua_cart', JSON.stringify(window._cart));
    window.location.href = '/checkout';
};

/* ── DOM ready ── */
document.addEventListener('DOMContentLoaded', function () {

    if (getCookie('tema') === 'dark') document.getElementById('themeIcon').textContent = '☀️';

    /* Search */
    const input   = document.getElementById('navSearchInput');
    const results = document.getElementById('navSearchResults');
    const clearBtn= document.getElementById('searchClear');

    clearBtn?.addEventListener('click', () => { input.value = ''; results.classList.remove('show'); input.focus(); });

    let timer;
    input?.addEventListener('input', function () {
        clearTimeout(timer);
        const q = this.value.trim();
        if (q.length < 2) { results.classList.remove('show'); return; }
        timer = setTimeout(() => doSearch(q), 300);
    });

    async function doSearch(q) {
        try {
            const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            const res   = await fetch(`/barang/search?keyword=${encodeURIComponent(q)}`, { headers: {'X-CSRF-TOKEN': token, 'Accept': 'application/json'} });
            const data  = await res.json();
            const icon  = k => k === 'galon' ? '💧' : k === 'botol' ? '🍶' : k === 'jerigen' ? '🪣' : '🥤';
            results.innerHTML = data.length
                ? data.slice(0, 5).map(b => `
                    <a class="search-result-item" href="/barang/${b.id}">
                        <span style="font-size:1.3rem">${icon(b.kategori)}</span>
                        <div>
                            <div style="font-weight:600">${b.nama_barang || b.name || b.nama}</div>
                            <div style="color:#0369a1;font-size:0.75rem">Rp ${Number(b.harga).toLocaleString('id-ID')}</div>
                        </div>
                    </a>`).join('')
                : '<div class="search-no-result">Produk tidak ditemukan</div>';
            results.classList.add('show');
        } catch(e) {
            results.innerHTML = '<div class="search-no-result">Gagal mengambil data</div>';
            results.classList.add('show');
        }
    }

    /* Tutup dropdown / search saat klik di luar */
    document.addEventListener('click', function (e) {
        if (!e.target.closest('.nav-search-wrap'))  results.classList.remove('show');
        if (!e.target.closest('.user-menu-wrap'))   document.getElementById('userDropdown')?.classList.remove('open');
    });

    /* User dropdown */
    document.getElementById('userMenuToggle')?.addEventListener('click', function (e) {
        e.stopPropagation();
        document.getElementById('userDropdown').classList.toggle('open');
    });

    /* Cart panel */
    const cartToggle  = document.getElementById('cartToggle');
    const cartPanel   = document.getElementById('cartPanel');
    const cartOverlay = document.getElementById('cartOverlay');
    const cartClose   = document.getElementById('cartClose');
    if (cartToggle) {
        cartToggle.addEventListener('click', () => { cartPanel.classList.add('open'); cartOverlay.classList.add('show'); });
        cartClose?.addEventListener('click',  closeCart);
        cartOverlay?.addEventListener('click', closeCart);
    }
    function closeCart() { cartPanel?.classList.remove('open'); cartOverlay?.classList.remove('show'); }
    window.closeCart = closeCart;
});
</script>
<?php /**PATH C:\xampp\htdocs\BioAquaLab\bioaqua\resources\views/partials/navbar.blade.php ENDPATH**/ ?>