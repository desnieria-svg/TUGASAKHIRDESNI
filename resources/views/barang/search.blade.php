@extends('layouts.app')

@section('title', 'Cari Produk')

@section('content')
<div class="container mt-4">
    <div class="card shadow-sm">
        <div class="card-body">

            <h5 class="card-title">🔍 Cari Produk Air Minum</h5>
            <p class="text-muted">Ketik nama, kode, atau kategori produk</p>

            {{-- Form Live Search --}}
            <div class="input-group mb-3">
                <input type="text"
                       id="input-search"
                       class="form-control form-control-lg"
                       placeholder="Contoh: galon, botol, CLEO..."
                       autocomplete="off">
                <span class="input-group-text">🔍</span>
            </div>

            {{-- Loading --}}
            <div id="search-loading" style="display:none;" class="text-muted mb-2">
                <div class="spinner-border spinner-border-sm text-primary"></div>
                Mencari produk...
            </div>

            {{-- Hasil pencarian --}}
            <div id="search-result"></div>

        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    const inputSearch = document.getElementById('input-search');
    const searchResult = document.getElementById('search-result');
    const searchLoading = document.getElementById('search-loading');

    let typingTimer;

    // Jalankan search 500ms setelah user berhenti mengetik
    inputSearch.addEventListener('keyup', function () {
        clearTimeout(typingTimer);
        const keyword = this.value.trim();

        if (keyword.length === 0) {
            searchResult.innerHTML = '';
            return;
        }

        typingTimer = setTimeout(() => liveSearch(keyword), 500);
    });

    async function liveSearch(keyword) {
        searchLoading.style.display = 'block';
        searchResult.innerHTML = '';

        try {
            const response = await fetch(`/barang/search?keyword=${encodeURIComponent(keyword)}`, {
                method: 'GET',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Accept': 'application/json'
                }
            });

            const data = await response.json();
            searchLoading.style.display = 'none';

            if (data.length === 0) {
                searchResult.innerHTML = `
                    <div class="alert alert-warning">
                        😕 Produk "<strong>${keyword}</strong>" tidak ditemukan.
                    </div>`;
                return;
            }

            // Tampilkan hasil dalam tabel
            let html = `
                <p class="text-muted small">Ditemukan <strong>${data.length}</strong> produk</p>
                <table class="table table-bordered table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>Kode</th>
                            <th>Nama Produk</th>
                            <th>Kategori</th>
                            <th>Stok</th>
                            <th>Harga</th>
                        </tr>
                    </thead>
                    <tbody>`;

            data.forEach(barang => {
                html += `
                    <tr>
                        <td>${barang.kode}</td>
                        <td>${barang.nama}</td>
                        <td><span class="badge bg-info text-dark">${barang.kategori}</span></td>
                        <td>${barang.jumlah} ${barang.satuan}</td>
                        <td>Rp ${parseInt(barang.harga).toLocaleString('id-ID')}</td>
                    </tr>`;
            });

            html += `</tbody></table>`;
            searchResult.innerHTML = html;

        } catch (error) {
            searchLoading.style.display = 'none';
            searchResult.innerHTML = `
                <div class="alert alert-danger">
                    ⚠️ Gagal melakukan pencarian. Coba lagi.
                </div>`;
        }
    }
</script>
@endpush