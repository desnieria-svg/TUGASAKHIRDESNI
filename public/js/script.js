// =======================================================
//  BioAqua Lab — script.js (FIXED)
//  Perbaikan: duplikasi event listener form submit digabung
// =======================================================

const hamburger   = document.getElementById('hamburger');
const navMenu     = document.getElementById('navMenu');
const navbar      = document.getElementById('navbar');
const backToTop   = document.getElementById('backToTop');
const toast       = document.getElementById('toast');
const toastMsg    = document.getElementById('toastMsg');
const formPesanan = document.getElementById('formPesanan');
const produkGrid  = document.getElementById('produkGrid');

// -------------------------------------------------------
//  1. TOGGLE MENU HAMBURGER
// -------------------------------------------------------
if (hamburger) {
  hamburger.addEventListener('click', function () {
    const isOpen = navMenu.classList.toggle('open');
    hamburger.classList.toggle('active');
    hamburger.setAttribute('aria-expanded', isOpen);
  });
}

// Tutup menu saat link diklik (UX mobile)
document.querySelectorAll('.nav-link').forEach(function (link) {
  link.addEventListener('click', function () {
    navMenu.classList.remove('open');
    if (hamburger) {
      hamburger.classList.remove('active');
      hamburger.setAttribute('aria-expanded', 'false');
    }
  });
});

// -------------------------------------------------------
//  2. NAVBAR SCROLL EFFECT + BACK TO TOP VISIBILITY
// -------------------------------------------------------
window.addEventListener('scroll', function () {
  if (window.scrollY > 10) {
    navbar.classList.add('scrolled');
  } else {
    navbar.classList.remove('scrolled');
  }

  if (window.scrollY > 350) {
    backToTop.classList.add('visible');
  } else {
    backToTop.classList.remove('visible');
  }
});

// -------------------------------------------------------
//  3. ANIMASI SCROLL — Intersection Observer
// -------------------------------------------------------
const aosObserver = new IntersectionObserver(
  function (entries) {
    entries.forEach(function (entry) {
      if (entry.isIntersecting) {
        entry.target.classList.add('aos-visible');
        aosObserver.unobserve(entry.target);
      }
    });
  },
  {
    threshold: 0.12,
    rootMargin: '0px 0px -40px 0px'
  }
);

document.querySelectorAll('[data-aos]').forEach(function (el, index) {
  el.style.transitionDelay = (index % 8) * 0.08 + 's';
  aosObserver.observe(el);
});

// -------------------------------------------------------
//  4. BACK TO TOP
// -------------------------------------------------------
if (backToTop) {
  backToTop.addEventListener('click', function () {
    window.scrollTo({ top: 0, behavior: 'smooth' });
  });
}

// -------------------------------------------------------
//  5. ACTIVE LINK NAVBAR
// -------------------------------------------------------
const allSections = document.querySelectorAll('section[id], footer[id]');
const allNavLinks = document.querySelectorAll('.nav-link');

window.addEventListener('scroll', function () {
  let currentId = '';

  allSections.forEach(function (section) {
    const top = section.getBoundingClientRect().top;
    if (top <= 90) {
      currentId = section.getAttribute('id');
    }
  });

  allNavLinks.forEach(function (link) {
    link.classList.remove('active');
    const href = link.getAttribute('href');
    if (href === '#' + currentId) {
      link.classList.add('active');
    }
  });
});

// -------------------------------------------------------
//  6. FILTER PRODUK
// -------------------------------------------------------
function filterProduk() {
  const checkedKat = [];
  document.querySelectorAll('.filter-group input[type="checkbox"][value]').forEach(function (cb) {
    if (cb.checked) checkedKat.push(cb.value);
  });

  const maxHarga = parseInt(document.getElementById('hargaRange').value);

  const kategoriPilihan = ['galon', 'botol', 'jerigen', 'cup'];
  const statusPilihan   = ['tersedia', 'habis'];

  const activeKat    = checkedKat.filter(v => kategoriPilihan.includes(v));
  const activeStatus = checkedKat.filter(v => statusPilihan.includes(v));

  const cards = produkGrid.querySelectorAll('.product-card');
  let terlihat = 0;

  cards.forEach(function (card) {
    const kat    = card.getAttribute('data-kategori');
    const harga  = parseInt(card.getAttribute('data-harga'));
    const status = card.getAttribute('data-status');

    const katOK    = activeKat.length === 0    || activeKat.includes(kat);
    const hargaOK  = harga <= maxHarga;
    const statusOK = activeStatus.length === 0 || activeStatus.includes(status);

    if (katOK && hargaOK && statusOK) {
      card.style.display = '';
      terlihat++;
    } else {
      card.style.display = 'none';
    }
  });

  const noProdukEl = produkGrid.querySelector('.no-produk');
  if (terlihat === 0) {
    if (!noProdukEl) {
      const p = document.createElement('p');
      p.className = 'no-produk';
      p.textContent = '😕 Tidak ada produk yang sesuai filter.';
      produkGrid.appendChild(p);
    }
  } else {
    if (noProdukEl) noProdukEl.remove();
  }
}

// -------------------------------------------------------
//  7. UPDATE LABEL HARGA RANGE
// -------------------------------------------------------
function updateHargaFilter(input) {
  const label  = document.getElementById('hargaLabel');
  const rupiah = new Intl.NumberFormat('id-ID', {
    style: 'currency', currency: 'IDR', maximumFractionDigits: 0
  }).format(input.value);
  label.textContent = rupiah;
  filterProduk();
}

// -------------------------------------------------------
//  8. RESET FILTER
// -------------------------------------------------------
function resetFilter() {
  document.querySelectorAll('.filter-group input[type="checkbox"]').forEach(function (cb) {
    cb.checked = true;
  });

  const rangeInput = document.getElementById('hargaRange');
  rangeInput.value = rangeInput.max;
  document.getElementById('hargaLabel').textContent = 'Rp 100.000';

  produkGrid.querySelectorAll('.product-card').forEach(function (card) {
    card.style.display = '';
  });

  const noProdukEl = produkGrid.querySelector('.no-produk');
  if (noProdukEl) noProdukEl.remove();

  tampilToast('✅ Filter berhasil direset!');
}

// -------------------------------------------------------
//  9. (dihapus) tambahKeranjang sekarang ditangani penuh oleh partials/navbar.blade.php
//     agar produk benar-benar masuk ke keranjang di semua halaman.
// -------------------------------------------------------

// -------------------------------------------------------
//  10. PREVIEW FOTO BARANG
// -------------------------------------------------------
function previewFoto(inputOrEvent) {
  // Support both: previewFoto(this) from inline onchange, and previewFoto(event) from addEventListener
  const input = inputOrEvent && inputOrEvent.target ? inputOrEvent.target : inputOrEvent;
  const file = input ? input.files[0] : null;

  // Try new IDs first (create.blade.php), fallback to old IDs
  const preview = document.getElementById('foto-preview') || document.getElementById('fotoPreview');
  const previewImg = document.getElementById('foto-img');
  const contentEl = document.getElementById('fileUploadContent');
  const icon = document.getElementById('dropzone-icon');
  const text = document.getElementById('dropzone-text');

  if (!file) return;

  // Validate size 2MB
  if (file.size > 2 * 1024 * 1024) {
    alert('Ukuran foto terlalu besar! Maksimal 2MB.');
    if (input) input.value = '';
    return;
  }

  const reader = new FileReader();
  reader.onload = function (e) {
    if (previewImg) {
      previewImg.src = e.target.result;
    }
    if (preview) {
      preview.style.display = 'block';
    }
    if (contentEl) {
      contentEl.style.display = 'none';
    }
    if (icon) icon.textContent = '✅';
    if (text) text.textContent = file.name;
  };
  reader.readAsDataURL(file);
}

// -------------------------------------------------------
//  11. SOROT FIELD YANG KOSONG
// -------------------------------------------------------
function sorotFieldKosong() {
  const fieldWajib = ['kodeBarang', 'namaBarang', 'kategori', 'jumlah', 'satuan', 'harga', 'tanggalMasuk', 'supplier'];

  fieldWajib.forEach(function (id) {
    const el = document.getElementById(id);
    if (el && !el.value.trim()) {
      el.style.borderColor = 'var(--danger)';
      el.addEventListener('input', function onInput() {
        el.style.borderColor = '';
        el.removeEventListener('input', onInput);
      }, { once: true });
    }
  });
}

// -------------------------------------------------------
//  12. RESET FORM
// -------------------------------------------------------
function resetForm() {
  if (formPesanan) {
    formPesanan.reset();
    editIndex = -1;

    const preview = document.getElementById('fotoPreview');
    const content = document.getElementById('fileUploadContent');
    if (preview) { preview.src = ''; preview.style.display = 'none'; }
    if (content) { content.style.display = ''; }

    setTanggalHariIni();
    tampilToast('🗑 Form berhasil direset.');
  }
}

// -------------------------------------------------------
//  13. NOTIFIKASI TOAST
// -------------------------------------------------------
let toastTimer = null;

function tampilToast(pesan) {
  toastMsg.textContent = pesan;
  toast.classList.add('show');

  if (toastTimer) clearTimeout(toastTimer);

  toastTimer = setTimeout(function () {
    toast.classList.remove('show');
  }, 3000);
}

// -------------------------------------------------------
//  14. SET TANGGAL HARI INI OTOMATIS
// -------------------------------------------------------
function setTanggalHariIni() {
  const inputTanggal = document.getElementById('tanggalMasuk');
  if (inputTanggal) {
    const sekarang = new Date();
    const yyyy = sekarang.getFullYear();
    const mm   = String(sekarang.getMonth() + 1).padStart(2, '0');
    const dd   = String(sekarang.getDate()).padStart(2, '0');
    inputTanggal.value = yyyy + '-' + mm + '-' + dd;
  }
}

// =======================================================
//  INVENTARIS — DATA & STATE
// =======================================================
let dataBarang = JSON.parse(localStorage.getItem('dataBarang')) || [];
let editIndex  = -1;

// -------------------------------------------------------
//  RENDER TABLE
// -------------------------------------------------------
function renderTable() {
  const tbody = document.querySelector('#dataTable tbody');
  if (!tbody) return;

  if (dataBarang.length === 0) {
    tbody.innerHTML = `
      <tr>
        <td colspan="10" style="text-align:center; color:#999; padding:24px;">
          Belum ada data. Isi form di bawah untuk menambahkan barang.
        </td>
      </tr>`;
    return;
  }

  tbody.innerHTML = '';

  dataBarang.forEach(function (item, index) {
    const statusClass = item.jumlah > 0 ? 'tersedia' : 'habis';
    const statusLabel = item.jumlah > 0 ? 'Tersedia' : 'Habis';

    const row = document.createElement('tr');
    row.innerHTML = `
      <td>${index + 1}</td>
      <td><span class="kode">${item.kode}</span></td>
      <td>${item.nama}</td>
      <td><span class="badge-kat ${item.kategori}">${item.kategori}</span></td>
      <td>${item.jumlah}</td>
      <td>${item.satuan}</td>
      <td>Rp ${Number(item.harga).toLocaleString('id-ID')}</td>
      <td>${item.supplier}</td>
      <td>${item.tanggal}</td>
      <td><span class="status ${statusClass}">${statusLabel}</span></td>
      <td>
        <button class="btn btn-primary btn-sm" onclick="editData(${index})">✏️ Edit</button>
        <button class="btn btn-sm" style="background:#e74c3c;color:#fff;" onclick="hapusData(${index})">🗑 Hapus</button>
      </td>
    `;
    tbody.appendChild(row);
  });
}

// -------------------------------------------------------
//  EDIT DATA
// -------------------------------------------------------
function editData(index) {
  const item = dataBarang[index];

  document.getElementById('kodeBarang').value  = item.kode;
  document.getElementById('namaBarang').value  = item.nama;
  document.getElementById('kategori').value    = item.kategori;
  document.getElementById('jumlah').value      = item.jumlah;
  document.getElementById('satuan').value      = item.satuan;
  document.getElementById('harga').value       = item.harga;
  document.getElementById('supplier').value    = item.supplier;
  document.getElementById('tanggalMasuk').value = item.tanggal;

  editIndex = index;
  tampilToast('✏️ Mode edit aktif — ubah data lalu klik Simpan');

  const form = document.getElementById('formPesanan');
  if (form) form.scrollIntoView({ behavior: 'smooth' });
}

// -------------------------------------------------------
//  HAPUS DATA
// -------------------------------------------------------
function hapusData(index) {
  if (confirm('Yakin mau hapus data ini?')) {
    dataBarang.splice(index, 1);
    localStorage.setItem('dataBarang', JSON.stringify(dataBarang));
    renderTable();
    updateStatistikInventaris();
    tampilToast('🗑 Data berhasil dihapus.');
  }
}

// -------------------------------------------------------
//  STATISTIK INVENTARIS
// -------------------------------------------------------
function updateStatistikInventaris() {
  const total   = dataBarang.length;
  const tersedia = dataBarang.filter(item => item.jumlah > 0).length;
  const habis   = dataBarang.filter(item => item.jumlah === 0).length;
  const menipis = dataBarang.filter(item => item.jumlah > 0 && item.jumlah < 5).length;

  const el = document.querySelector('.table-summary');
  if (el) {
    el.innerHTML = `<p>
      Total: <strong>${total} item</strong> terdaftar &nbsp;|&nbsp;
      Stok tersedia: <strong>${tersedia} item</strong> &nbsp;|&nbsp;
      Habis: <strong>${habis} item</strong>
      ${menipis > 0 ? `&nbsp;|&nbsp; ⚠️ Menipis: <strong>${menipis} item</strong>` : ''}
    </p>`;
  }
}

// -------------------------------------------------------
//  FORM SUBMIT — SATU HANDLER TERPADU (validasi + simpan)
// -------------------------------------------------------
if (formPesanan) {
  formPesanan.addEventListener('submit', function (e) {
    e.preventDefault();

    // Ambil nilai semua field
    const kode     = document.getElementById('kodeBarang').value.trim();
    const nama     = document.getElementById('namaBarang').value.trim();
    const kategori = document.getElementById('kategori').value;
    const jumlah   = document.getElementById('jumlah').value;
    const satuan   = document.getElementById('satuan').value;
    const harga    = document.getElementById('harga').value;
    const tanggal  = document.getElementById('tanggalMasuk').value;
    const supplier = document.getElementById('supplier').value.trim();

    // Validasi field wajib
    if (!kode || !nama || !kategori || !jumlah || !satuan || !harga || !tanggal || !supplier) {
      tampilToast('❌ Harap isi semua field yang wajib diisi!');
      sorotFieldKosong();
      return;
    }

    if (parseInt(jumlah) < 1) {
      tampilToast('❌ Jumlah harus lebih dari 0!');
      return;
    }

    if (parseInt(harga) < 0) {
      tampilToast('❌ Harga tidak boleh negatif!');
      return;
    }

    // Buat objek item baru
    const item = { kode, nama, kategori, jumlah: Number(jumlah), satuan, harga: Number(harga), supplier, tanggal };

    if (editIndex === -1) {
      // Mode tambah baru
      dataBarang.push(item);
      tampilToast('✅ Data berhasil disimpan! Kode: ' + kode);
    } else {
      // Mode edit
      dataBarang[editIndex] = item;
      tampilToast('✅ Data berhasil diperbarui! Kode: ' + kode);
      editIndex = -1;
    }

    // Simpan ke localStorage
    localStorage.setItem('dataBarang', JSON.stringify(dataBarang));

    // Update tampilan
    renderTable();
    updateStatistikInventaris();

    // Reset form setelah 1 detik
    setTimeout(function () {
      resetForm();
    }, 1000);
  });
}

// -------------------------------------------------------
//  INISIALISASI — dijalankan saat halaman pertama dimuat
// -------------------------------------------------------
document.addEventListener('DOMContentLoaded', function () {
  setTanggalHariIni();

  const rangeInput = document.getElementById('hargaRange');
  if (rangeInput) updateHargaFilter(rangeInput);

  renderTable();
  updateStatistikInventaris();
});